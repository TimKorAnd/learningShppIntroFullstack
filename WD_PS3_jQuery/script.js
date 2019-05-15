'use strict';
$(document).ready(function(){
    $("button").click(function(){
        $("#test").toggle();
    });


    let sel = new Select('test-select');
    //sel.showSelect();

});

class Select {
    fetched = false;


    choosedOption = '';
    constructor(selectClassName) {
        this.selectElement = $('#'.concat(selectClassName));
        //let selEl = this.selectElement;
        this.width = this.selectElement.width();
        this.height = this.selectElement.height(); //TODO may use initial height
        //this.options = this.selectElement.html().split(/(?<=<\/div>).*?(?=<div>)/);// TODO use getchild
        let options = this.selectElement.children();
        //this.createElemsArray();
        this.choosedOption = options[0];
        console.log(options);
        //this.addEventsToArrayedOptions(selectClassName, options);
        this.setEventsToOptions(selectClassName);
        //this.showSelect();
    }

    addEventsToArrayedOptions(selectClassName, options) {
        $(options).on('click',options, function(event){
            let selectedElement = $(event.target);
            /*unwrap possible inner html elem to select option  == div*/
            while (((selectedElement).parent().attr('class')) === undefined || !((selectedElement).parent().attr('class')).includes(selectClassName)){
                selectedElement = $(selectedElement).parent();
            }
            let activeElement = $(options[0]);
            if (selectedElement[0] === activeElement[0]){
                console.log('equal');
            }
            /*$(activeElement).replaceWith($(selectedElement));
            activeElement.insertAfter(selectedElement);*/
        });

    }

    /*wo array, DOM only*/
    setEventsToOptions(selectClassName) {
        $(this.selectElement).on('click', function(event){
            let selectedElement = event.target; // why if add $, then in while jquery elems not equals(((?
            let activeElement = $($(this).children()[0]);
            /*when clicked not on DIV option but on main select-DIV */
            if (event.currentTarget === selectedElement) {return;}
            /*unwrap inner html elem to select option  == div*/
            while (($(selectedElement).parent().attr('class')) === undefined || !($(selectedElement).parent().attr('class')).includes(selectClassName)){
                selectedElement = $(selectedElement).parent();
            }

            //if (activeElement[0] === selectedElement[0] || activeElement[0] === selectedElement){
            if (activeElement.toArray().some((actElem)=>{return $(selectedElement).toArray().some((selElem)=>{return actElem === selElem;})})){
                console.log('equal');


                return;
            }
            /*replace active element by selected in DOM*/
            $(activeElement).replaceWith($(selectedElement));
            activeElement.insertAfter(selectedElement);

        });
    }

    fetchSelect() {
        this.selectElement.empty();

        //this.selectElement = this.choosedOption;
        this.selectElement.html(this.choosedOption);
        /*this.showSelect();*/
        this.selectElement.css('position','relative');
        let heightElems = this.selectElement.height();
        //let heightElems = 20;
        this.options.forEach((v,i) => {
            if (v === this.choosedOption) {
                console.log(v);
                return;} //TODO kill listener?
            v.addClass('select-shown')
                .css('position','absolute')
                .css('display','block')
                .css('top',heightElems)
                .css('width',this.width).
            off('click').click(() => {this.choosedOption = v;
                this.showSelect.bind(this)});

            this.selectElement.append(v);
            console.log(v);
            heightElems += v.height();
            //heightElems += 20;
        })
        this.fetched = !this.fetched;
    }


    showSelect() {
        this.selectElement.empty();

        this.selectElement.html(this.choosedOption)
            .addClass('select-shown').css('width',this.width).off('click').click(this.fetchSelect.bind(this));

    }

    createElemsArray() {
        this.options.forEach((v,i)=>{

            /* let currElem = $(v);*/
            /*click(() => {
                    this.choosedOption = v;
                    this.showSelect.bind(this)});*/
            this.options[i] = $(v);

        });
        console.log(this.options);
    }


}