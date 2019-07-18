'use strict';

const API_URL = 'https://picsum.photos/60';
const DOM_VK_UP = 38;
const DOM_VK_DOWN = 40;

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
    //sel.showSelect();

});


class Select {

    constructor(selectClassName, optionsList) {
        this.creatCustomSelectElem(selectClassName, optionsList);
        const $sel = $('.' + selectClassName);
        $sel.width(this.getMaxOptWidt($sel));
        /*set height for wrapper*/
        $(`#${selectClassName}`).height($sel.outerHeight(true) *1.3);
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
                console.log(maxWidth);
            }
        })
        $sel.children('li:not(:first-child)').addClass('option-hide');
        return maxWidth ;
    }

    creatCustomSelectElem(customSelectClassName, optionsList) {
        const $customSelectElement = $('<ul></ul>').addClass(customSelectClassName);
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

    eventsAttach($sel) {

        $sel.children('li:not(:first-child)').on('mouseenter', (e) => {
            $(e.target).closest('li').focus();
        }).on('mouseleave', (e) => {
            $(e.target).closest('li').blur();
        });

        $sel.children('li:first-child').on('mouseenter', (e) => {
            $sel.css('border-color', 'cadetblue');
            //$sel.focus();
        }).on('mouseleave', (e) => {
            $sel.css('border-color', 'black');
            //$sel.blur();
        });

        $sel.on('focus',(e) =>{
            console.log(`${e.target} in focus`);})
            .on('blur',() =>{
                console.log('in blur')})
            .on('mouseenter',(e) =>{
                $(e.target).focus();
            })
            .on('mouseleave',(e) =>{
                $(e.target).blur();
            })
            .on('keydown', (e) => {
                this.changeOptionsByKeys($sel,e.keyCode);
                console.log(e.keyCode + ' keydown');


            });


        $sel.children('li:not(:first-child)').on('click', (e) => {
            $sel.children('li').first().children('img').attr('src',
                $(e.target).closest('li').children('img').attr('src'));


            $sel.children('li').first().children('span').html(
                $(e.target).closest('li').children('span').html());

            $sel.children('li:not(:first-child)').addClass('option-hide');
            $sel.children('li').attr('tabindex',0);
            $(e.target).closest('li').attr('tabindex',1);


        })

        $sel.children('li:first-child').on('click', (e) => {
            $sel.find('li:not(:first-child)').toggleClass('option-hide')
            $sel.children("li[tabindex='1']").focus();
        }).on('keydown', (e) => {
            console.log('keydown');
        });



        $(document).on('click.custom-select',(e) => {
            if ($(e.target).closest('.custom-select').length === 0) {
                $sel.find('li:not(:first-child)').addClass('option-hide');
            }
        })



    }

    changeOptionsByKeys($sel, keyCode) {


        const $titleOption =  $sel.children('li').first();
        let $currOption = $sel.children("li[tabindex='1']");

        function upOption() {
            $currOption = $currOption.is(':first-child') |
            $currOption.is(':nth-child(2)') ? $sel.children('li:last') :
                $currOption.prev('li');
            $currOption.click();
        }

        function downOption() {

        }

        switch (keyCode) {
            case  DOM_VK_UP: {
                upOption();
                break;
            }
            case DOM_VK_DOWN: {
                downOption();
                break;
            }
        };


    }

}