'use strict';
$(document).ready(function(){
    $("button").click(function(){
        $("#test").toggle();
    });


    let sel = new Select('test-select');
    //sel.showSelect();

});


class Select {

    constructor(selectClassName) {
        this.selectElement = $('#'.concat(selectClassName));
        //let selEl = this.selectElement;
        this.width = this.selectElement.width();
        this.height = this.selectElement.height(); //TODO may use initial height
        this.maxHeight = this.getMaxHeight($(this.selectElement).find('*'));
        this.setEventsToOptions(selectClassName, this.maxHeight);
        $(this.selectElement.children()[0]).height(this.maxHeight);
        $(this.selectElement).height(this.maxHeight);
        //$(this.selectElement).css('background-color','white').css('transparency',0);
        $(this.selectElement).addClass('option-position');
        this.selectElement.children()[0].click();
        //TODO prepare select decomposition to  meth
    }


    /*ret max height of select inner elems*/
    getMaxHeight(selectElement) {
        let maxHeight = 0;
        $(selectElement).each((ind, child) => {
            const tempHeight = $(child).outerHeight(true);
            console.log(tempHeight);
            maxHeight = tempHeight > maxHeight ? tempHeight : maxHeight;
        });
        return maxHeight;
    }


    /*wo array, DOM only*/
    setEventsToOptions(selectClassName, maxHeight) {
        $(this.selectElement).on('click enterpressed', function(event){
            //$(this).children().addClass('select-shown');
            let selectedElement = event.target; // why if add $, then in while jquery elems not equals(((?
            const activeElement = $($(this).children()[0]);
            /*when clicked not on div option but on main select div */
            if (event.currentTarget === selectedElement) {return;}
            /*unwrap inner html elem to select option  == div*/
            while (($(selectedElement).parent().attr('class')) === undefined || !($(selectedElement).parent().attr('class')).includes(selectClassName)){
                selectedElement = $(selectedElement).parent();
            }

            //if (activeElement[0] === selectedElement[0] || activeElement[0] === selectedElement){
            if (activeElement.toArray().some((actElem)=>{return $(selectedElement).toArray().some((selElem)=>{return actElem === selElem;})})){
                console.log('equal');

                $(this).children('*:not(:first-child)').toggleClass('select-not-shown');

                let sumHeight = 0;
                $(this).children().each((ind, child) => {
                    $(child).css('position', 'absolute').css('top', sumHeight);
                    sumHeight += $(child).height();
                });
                //$(this).height($($(this).children()[0]).height());
                $($(this).children()[0]).removeClass('select-not-shown').addClass('select-shown');
                $(this).height(maxHeight);

                return;
            }
            /*replace active element by selected in DOM*/
            $(activeElement).replaceWith($(selectedElement));
            activeElement.insertAfter(selectedElement);

            /*show first (chosed) hide other*/
            $(this).children().removeClass('select-shown').addClass('select-not-shown');
            $($(this).children()[0]).removeClass('select-not-shown').addClass('select-shown').css('position','absolute')
                .css('top',0);

        });

    }



}