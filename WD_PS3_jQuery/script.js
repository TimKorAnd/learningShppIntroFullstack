'use strict';

const API_URL = 'https://picsum.photos/60';
const DOM_VK_UP = 38;
const DOM_VK_DOWN = 40;
const DOM_VK_ENTER = 13;
const BOTTOM_MARGIN = 30;

const OPTIONS = [
    {name:'select'+'&nbsp'+'one'+'&nbsp'+'option', src:'?image=1081'},
    {name:'nameeeeeeeeeeeeeefgdfgdfdfgdfgsdfgdfgee1', src:'?image=1080'},
    {name:'nameeeeeeee2', src:'?image=1079'},
    {name:'nameeeee3', src:'?image=1078'},
    {name:'name4', src:'?image=1077'},
    {name:'na5', src:'?image=1076'},
    {name:'gg', src:'?image=1075'},
    {name:'name7', src:'?image=1074'},
];
$(() => {

    let sel = new Select('custom-select', OPTIONS);

});

class Select {

    constructor(selectClassName, optionsList) {
        this.creatCustomSelectElem(selectClassName, optionsList);
        const $sel = $('.' + selectClassName);
        $sel.width(this.getMaxOptWidt($sel));
        /*set height for wrapper*/
        $(`#${selectClassName}`).height($sel.outerHeight(true) + BOTTOM_MARGIN);
        $sel.attr('tabindex',0);
        this.eventsAttach($sel);
    }

    /*get width for custom select depend max option length (if it >) or given by attribute*/
    getMaxOptWidt($sel) {
        let maxWidth = +$sel.attr('minWidth');
        $sel.children('li:not(:first-child)').removeClass('option-hide');
        $sel.children().each((i, currElem) => {
            let liWidth = $(currElem).outerWidth(true) + 100;//$(currElem).find('img').width(); //100 = IMG.outerWidth
            if (liWidth  > maxWidth) {
                maxWidth = liWidth;
            }
        })
        $sel.children('li:not(:first-child)').addClass('option-hide');
        return maxWidth ;
    }

    creatCustomSelectElem(customSelectClassName, optionsList) {
        const $customSelectElement = $('<ul></ul>').addClass(customSelectClassName).attr('tabindex',1);
        const $customSelectWrapper = $(`#${customSelectClassName}`);
        $customSelectElement.attr('minWidth', $customSelectWrapper.attr('minWidth'));
        $customSelectWrapper.prepend($customSelectElement);
        optionsList.forEach((optElem, i) =>{
            const $optionElem = $('<li>').addClass('select-option');
            $optionElem.addClass('option-hide');
            const $optImgElem = $('<img>').attr('src',`${API_URL}/${optElem.src}`);
            const $optNameElem = $('<span>').html(optElem.name);

            $optionElem.append($optImgElem)
                .append($optNameElem)
                .attr('tabindex',0);

            $customSelectElement.append($optionElem);
        })
        $customSelectElement.children('li').first().removeClass('option-hide').attr('tabindex',1);

    }

    mouseEnterHandler(e) {
        $(e.target).closest('ul').children('li').attr('tabindex', 0).blur();
        $(e.target).closest('li').focus().attr('tabindex', 1);
    }

    eventsAttach($sel) {
        $sel.children('li:not(:first-child)').on('mousemove', this.mouseEnterHandler);

        $sel.children('li:not(:first-child)').on('mouseenter', this.mouseEnterHandler)
            .on('mouseleave', (e) => {
                /*if (!$(e.target).closest('li').hasClass('option-hide'))
                $(e.target).closest('li').blur().attr('tabindex', 0);*/
                $(e.target).closest('li').blur();
        });

        $sel.children('li:first-child').on('mouseenter', (e) => {
            $sel.css('border-color', 'cadetblue');
            $sel.focus();
        }).on('mouseleave', (e) => {
            $sel.css('border-color', 'black');
            $sel.blur();
        });

        $sel.on('keydown', (e) => {
            this.changeOptionsByKeys($sel, e.keyCode);
            });

        $sel.children('li:not(:first-child)').on('click', (e) => {
            this.setTitleOptionBySelected($sel, $(e.target));
            $sel.children('li:not(:first-child)').addClass('option-hide');
        })

        $sel.children('li:first-child').on('click', (e) => {
            $sel.find('li:not(:first-child)').toggleClass('option-hide')
            $sel.children("li[tabindex='1']").focus();
        });

        $(document).on('click.custom-select',(e) => {
            if ($(e.target).closest('.custom-select').length === 0) {
                $sel.find('li:not(:first-child)').addClass('option-hide');
            }
        })
    }

    setTitleOptionBySelected($sel, $selectedOption) {
        $sel.children('li').first().children('img').attr('src',
            $selectedOption.closest('li').children('img').attr('src'));
        $sel.children('li').first().children('span').html(
            $selectedOption.closest('li').children('span').html());
        $sel.children('li').attr('tabindex',0);
        $selectedOption.closest('li').attr('tabindex',1).focus();
    }

    changeOptionsByKeys($sel, keyCode) {
        $sel.children('li:not(:first-child)').off('mouseenter', this.mouseEnterHandler).blur();
        let $currOption = $sel.children("li[tabindex='1']").blur();

        switch (keyCode) {
            case  DOM_VK_UP: {
                this.setTitleOptionBySelected($sel, this.upOption($sel, $currOption));
                break;
            }
            case DOM_VK_DOWN: {
                this.setTitleOptionBySelected($sel, this.downOption($sel, $currOption));
                break;
            }
            default: $currOption.click();
        };

    }

    upOption($sel, $currOption) {

        return $currOption.is(':first-child') | $currOption.is(':nth-child(2)') ?
            $sel.children('li:last') :
            $currOption.prev('li');
    }

    downOption($sel, $currOption) {

        return $currOption.is(':last-child') ?
            $sel.children('li:nth-child(2)') :
            $currOption.next('li');
    }
}