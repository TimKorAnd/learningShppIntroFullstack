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
        this.maxHeight = this.getMaxSize($(this.selectElement).find('*'),(elem) => {return $(elem).outerHeight(true);});
        this.maxWidth = this.getMaxSize($(this.selectElement).find('*'),(elem) => {return $(elem).outerWidth(true);});
        this.setEventsToOptions(selectClassName, this.maxHeight);
        $(this.selectElement.children()[0]).height(this.maxHeight);
        $(this.selectElement).height(this.maxHeight);
        //$(this.selectElement).css('background-color','white').css('transparency',0);
        $(this.selectElement).addClass('option-position');
        this.selectElement.children()[0].click();
        //TODO prepare select decomposition to  meth
    }

    transformElemsToSelectOptions(){

    }


    /*ret max height or width (depends by getSize func)of select inner elems*/
    getMaxSize(selectElement, getSize) {
        let maxSize = 0;
        $(selectElement).each((ind, child) => {
            const tempSize = getSize(child);
            console.log(`h: ${tempSize} `);
            maxSize = tempSize > maxSize ? tempSize : maxSize;
        });
        return maxSize;
    }


    /*wo array, DOM only*/
    setEventsToOptions(selectClassName, maxHeight) {
        $(this.selectElement).on('click enterpressed', function(event){
            //$(this).children().addClass('select-shown');
            let selectedElement = event.target; // why if add $, then in while jquery elems not equals(((?
            const activeElement = $($(this).children()[0]);
            /*when clicked not on div option but on main select div */
            if (event.currentTarget === selectedElement) {
                console.log('add handler');
                return;}
            /*unwrap inner html elem to select option  == div*/
            while (($(selectedElement).parent().attr('class')) === undefined || !($(selectedElement).parent().attr('class')).includes(selectClassName)){
                selectedElement = $(selectedElement).parent();
            }

            //if active element equal to selected(target) fetch / shrink
            if (activeElement.toArray().some((actElem)=>{return $(selectedElement).toArray().some((selElem)=>{return actElem === selElem;})})){
                console.log('equal');

                $(this).children('*:not(:first-child)').toggleClass('select-not-shown').css('width','100');

                let sumHeight = 0;
                $(this).children().each((ind, child) => {
                    $(child).css('position', 'absolute').css('top', sumHeight);
                    sumHeight += $(child).height();
                });
                //$(this).height($($(this).children()[0]).height());
                /*$($(this).children()[0]).removeClass('select-not-shown').addClass('select-shown');
                $(this).height(maxHeight);*/

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