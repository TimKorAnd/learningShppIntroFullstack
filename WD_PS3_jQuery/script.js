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
            console.log(`enter ${$(e.target).closest('li')}`);
        }).on('mouseleave', (e) => {
            $(e.target).closest('li').css('color', 'black');
            console.log(`leave ${$(e.target).closest('li')}`);
        })

        $sel.children('li').on('click', (e) => {
            $(e.target).closest('li').not(':first-child').addClass('option-hide');
        })

    }

}