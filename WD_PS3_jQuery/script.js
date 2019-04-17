/*
$(() => {
    console.log('test arrow func inside jquery');


    let cat = new Kitten()
        .setName('Bob')
        .setColor('black')
        .setGender('male')
        .save();

    console.log(cat);

});
class SelectElement{
    constructor(){

    }

}
window.onload = ()=>{
    console.log('onload worked');
};
class Kitten {
    constructor() {
        this.name = 'Garfield';
        this.color = 'brown';
        this.gender = 'male';
    }

    setName(name) {
        this.name = name;
        return this;
    }

    setColor(color) {
        this.color = color;
        return this;
    }

    setGender(gender) {
        this.gender = gender;
        return this;
    }

    save() {
        console.log(
            `saving ${this.name}, the ${this.color} ${this.gender} kitten`
        );

        // save to database

        return this;
    }
}
*/
'use strict';
$(document).ready(function(){
    /* $("button").click(function(){
         $("#test").hide();
     });
 */
    $('#try-it').click((event) => {
        $("#test").hide();
        console.log(event.target.nodeName);
        console.log($("#demo").text());
        $("#demo").html( event.target.id);
    });
    let sel = new Select('test-select');
    //sel.showSelect();

});

class Select {
    START_TEG = '<div>';
    END_TEG = '</div>';


    choosedOption = '';
    constructor(selectClassName) {
        this.selectElement = $('#'.concat(selectClassName));
        this.width = this.selectElement.width();
        this.height = this.selectElement.height(); //TODO may use initial height
        this.options = this.selectElement.html().split(/(?<=<\/div>).*?(?=<div>)/);
        this.choosedOption = this.options[0];
        console.log(this.options);
        //this.setEventsToOptions();
        this.showSelect();
    }

    setEventsToOptions() {
        console.log('setEventsToOptions ' + this.selectElement);
        this.selectElement.click(this.fetchSelect.bind(this));

    }

    fetchSelect() {
        this.selectElement.html(this.START_TEG + this.choosedOption + this.END_TEG);
        this.selectElement.css('position','relative');
        let heightElems = this.selectElement.height();
        this.options.forEach((v,i)=>{
            if (v === this.choosedOption) return; //TODO kill listener?

            let currElem = $(this.START_TEG + v + this.END_TEG).addClass('select-shown')
                .css('position','absolute')
                .css('top',heightElems)
                .css('width',this.width)
                .click(() => {
                    this.choosedOption = v;
                    this.showSelect.bind(this)});
            this.selectElement.append(currElem);
            heightElems += currElem.height();
        })
    }


    showSelect() {
        this.selectElement.empty();

        this.selectElement.html(this.START_TEG + this.choosedOption + this.END_TEG)
            .addClass('select-shown').css('width',this.width).click(this.fetchSelect.bind(this));




    }
}



