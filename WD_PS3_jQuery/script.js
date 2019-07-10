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

        this.renderSelect(selectClassName, optionsList, 2);
        const $sel = $('.' + selectClassName);
        this.eventsAttach($sel);
    }

    renderSelect(selectClassName, optionsList, choosedElemInd) {
        const $selDomElement = $('<ul></ul>').addClass(selectClassName);
            /*.prepend('<span id="select-one-off-title">select one option</span>');*/
        $(`#${selectClassName}`).prepend($selDomElement);
        optionsList.forEach((optElem, i) =>{
            const $liDOMElem = $('<li>').addClass('select-option');
            if (i !== choosedElemInd) {
                $liDOMElem.addClass('option-hide');
            }
            const $optImgDOMElem = $('<img>').attr('src',`${API_URL}/${optElem.src}`);
            const $optNameDOMElem = $('<span>').html(optElem.name);
            $liDOMElem.append($optImgDOMElem).append($optNameDOMElem);
            $selDomElement.append($liDOMElem);
        })
    }

    eventsAttach($sel) {

        $sel.children('li').on('mouseenter', (e) => {
            $(e.target).closest('li').css('color', 'blue');

        }).on('mouseleave', (e) => {
            $(e.target).closest('li').css('color', 'black');

        });

        $sel.children('li').on('click', (e) => {
            $(e.target).closest('li').not(':first-child').addClass('option-hide');
            //return false;
        })

        $sel.children('li:first-child').on('click', (e) => {
            $sel.find('li').removeClass('option-hide');
            //return false;
        })

        $(document).on('click.custom-select',(e) => {
            if ($(e.target).closest('.custom-select').length === 0) {
                $sel.find('li:not(:first-child)').addClass('option-hide');
            }
        })

    }

}