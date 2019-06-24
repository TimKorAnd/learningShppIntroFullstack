'use strict';
$(document).ready(function(){

    let sel = new Select('.custom-select');
    //sel.showSelect();

});


class Select {

    constructor(selectClassName) {
        const $sel = $(selectClassName);
        this.eventsAttach($sel);
    }

    eventsAttach($sel) {
        /*$sel.children('li').each((i, elem) => {
            $(elem).on('mouseenter', () => {
                $(elem).css('color', 'blue');
            }).on('mouseout', () => {
                $(elem).css('color', 'black');
            })
        })*/
        $sel.children('li').on('mouseenter', (e) => {
            $(e.target).closest('li').css('color', 'blue');

        }).on('mouseleave', (e) => {
            $(e.target).closest('li').css('color', 'black');

        })

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