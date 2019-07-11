'use strict';

const API_URL = 'https://picsum.photos/60';

const OPTIONS = [
    {name:'select one option', src:'?image=1081'},
    {name:'name1', src:'?image=1080'},
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
        this.eventsAttach($sel);
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
            $(e.target).closest('li').css('color', 'blue');

        }).on('mouseleave', (e) => {
            $(e.target).closest('li').css('color', 'black');

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