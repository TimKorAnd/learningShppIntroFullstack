'use strict';

const API_URL = 'https://picsum.photos/60';
const DOM_VK_UP = 38;
const DOM_VK_DOWN = 40;
const DOM_VK_ENTER = 13;
const BOTTOM_MARGIN = 30;
const SELECT_TITLE = {name:'select'+'&nbsp'+'one'+'&nbsp'+'option', src:'?image'};

const OPTIONS = [
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
        optionsList.unshift(SELECT_TITLE);
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

    eventsAttach($select) {
        $select.children('li:not(:first-child)').on('mousemove', this.mouseEnterHandler);

        $select.children('li:not(:first-child)').on('mouseenter', this.mouseEnterHandler)
            .on('mouseleave', (e) => {
                /*if (!$(e.target).closest('li').hasClass('option-hide'))
                $(e.target).closest('li').blur().attr('tabindex', 0);*/
                $(e.target).closest('li').blur();
            });

        $select.children('li:first-child').on('mouseenter', (e) => {
            $select.css('border-color', 'cadetblue');
            $select.focus();
        }).on('mouseleave', (e) => {
            $select.css('border-color', 'black');
            $select.blur();
        });

        $select.on('keydown', (e) => {
            this.changeOptionsByKeys($select, e.keyCode);
            /*$(e.target).focus();*/
        });

        $select.children('li:first-child').on('keydown', (e) => {

            this.changeOptionsByKeys($select, e.keyCode);
            if ($select.find('li:not(:first-child)').hasClass('option-hide')/* || !$select.find('li:not(:first-child)').is(':hidden')*/ )
            {
                e.stopPropagation();
                /*$(e.target).focus();*/
            }
        });

        $select.children('li:not(:first-child)').on('click', (e) => {
            this.setTitleOptionBySelected($select, $(e.target));
            $select.children('li:not(:first-child)').slideUp(200, () => {
                $select.children('li:not(:first-child)').addClass('option-hide').removeAttr('style')});
            $(e.target).focus();
        })

        $select.children('li:first-child').on('click', (e) => {
            if (!$select.find('li:not(:first-child)').hasClass('option-hide')/* || !$select.find('li:not(:first-child)').is(':hidden')*/ ) {
                $select.find('li:not(:first-child)').slideUp(200, () => {
                    $select.children('li:not(:first-child)').addClass('option-hide').removeAttr('style')});
            } else {
                $select.find('li:not(:first-child)').removeClass('option-hide').show();
            }/*$select.find('li:not(:first-child)').slideDown(200, () => {
                    $select.children('li:not(:first-child)').removeClass('option-hide')}).removeAttr('style').attr('display', 'flex');
            }*/

            $select.children("li[tabindex='1']").removeAttr('style').focus();
            $(e.target).focus();

        });

        $(document).on('click.custom-select',(e) => {
            if ($(e.target).closest('.custom-select').length === 0) {
                $select.find('li:not(:first-child)').slideUp(200, () => {
                    $select.children('li:not(:first-child)').addClass('option-hide').removeAttr('style')});
            }
        })
    }

    setTitleOptionBySelected($sel, $clickElem) {
        const $selectedOption = $clickElem.closest('li');
        const $titleElement = $sel.children('li').first();
        $titleElement.children('img').attr('src',
            $selectedOption.children('img').attr('src'));
        $titleElement.children('span').html(
            $selectedOption.children('span').html());
        $sel.children('li').attr('tabindex',0);
        $selectedOption.attr('tabindex',1).focus();
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