'use strict';

const API_URL = 'https://picsum.photos/60';

const OPTIONS = [
    {name:'select'+'&nbsp'+'one'+'&nbsp'+'option', src:'?image=1081'},
    {name:'nameeeeeeeeeeeeeeeeeeeeee1', src:'?image=1080'},
    {name:'name2', src:'?image=1079'},
    {name:'name3', src:'?image=1078'},
    {name:'name4', src:'?image=1077'},
    {name:'name5', src:'?image=1076'},
    {name:'name6', src:'?image=1075'},
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
        this.eventsAttach($sel);
    }

  /*  getMaxOptWidt(options) {
        return options.reduce((maxWidth, curr) => {
            return  curr.name.length > maxWidth ? curr.name.length : maxWidth;
        })
    }*/

    getMaxOptWidt($sel) {
        let maxWidth =150;
        $sel.children('li').each((i, currElem) => {
            if ($(currElem).outerWidth() > maxWidth) {
                maxWidth = $(currElem).outerWidth();
            }
        })
        return maxWidth *1.25 + 50;
    }

    creatCustomSelectElem(customSelectClassName, optionsList) {
        const $customSelectElement = $('<ul></ul>').addClass(customSelectClassName);
            /*.prepend('<span id="select-one-off-title">select one option</span>');*/
        $(`#${customSelectClassName}`).prepend($customSelectElement);
        optionsList.forEach((optElem, i) =>{
            const $optionElem = $('<li>').addClass('select-option');
            $optionElem.addClass('option-hide');
            const $optImgElem = $('<img>').attr('src',`${API_URL}/${optElem.src}`);
            const $optNameElem = $('<span>').html(optElem.name);
            $optionElem.append($optImgElem).append($optNameElem);
            $customSelectElement.append($optionElem);
        })
        $customSelectElement.children('li').first().removeClass('option-hide');

    }

    eventsAttach($sel) {

        $sel.children('li').on('mouseenter', (e) => {
            $(e.target).closest('li').css('color', 'white')
                .css('background-color','gray');

        }).on('mouseleave', (e) => {
            $(e.target).closest('li').css('color', 'black')
                .css('background-color','white');

        });

        $sel.children('li:not(:first-child)').on('click', (e) => {
            $sel.children('li').first().children('img').attr('src',
            $(e.target).closest('li').children('img').attr('src'));

            $sel.children('li').first().children('span').html(
                $(e.target).closest('li').children('span').html());

            $sel.children('li:not(:first-child)').addClass('option-hide');

        })

        $sel.children('li:first-child').on('click', (e) => {
            $sel.find('li:not(:first-child)').toggleClass('option-hide');
            //return false;
        })

        $(document).on('click.custom-select',(e) => {
            if ($(e.target).closest('.custom-select').length === 0) {
                $sel.find('li:not(:first-child)').addClass('option-hide');
            }
        })

    }

}