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
        $sel.children('li').each((i, elem) => {
            $(elem).on('mouseenter', () => {
                $(elem).css('color', 'blue');
            }).on('mouseout', () => {
                $(elem).css('color', 'black');
            })
        })
    }

}