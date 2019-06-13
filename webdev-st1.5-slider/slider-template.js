'use strict';

const API_URL = 'https://picsum.photos/';
const BIG_SIZE = '600/400';
const SMALL_SIZE = '60';

const IMAGES = [
  '?image=1080',
  '?image=1079',
  '?image=1069',
  '?image=1063',
  '?image=1050',
  '?image=1039'
];

const DOM_VK_LEFT = 37;
const DOM_VK_RIGHT = 39;

$(() => {
 const slider = new Slider();
});

class Slider {
  constructor(){
    this.showImgPreviews();
    this.slider = $('#slider');
    this.imgPreview = $('#slider-preview li img');
    this.currImgIndex = 0;
    this.setEventsToSliderElems();
    this.imgPreview[0].click();
    //this.showCurrentImage();
  }

  showImgPreviews(){
    const sliderPrev = $('#slider-preview');
    IMAGES.forEach((imgElem, i) =>{
      const liDOMElem = $('<li></li>');
      const imgDOMElem = $('<img>').attr('src',`${API_URL}${SMALL_SIZE}/${imgElem}`).attr('alt',i);
      liDOMElem.append(imgDOMElem);
      sliderPrev.append(liDOMElem);
    })
  }

  setEventsToSliderElems(){
    $('html').keydown((e) => {
      if (e.keyCode === DOM_VK_LEFT) {
        this.leftShift();
      }
    }).keydown((e) => {
      if (e.keyCode === DOM_VK_RIGHT) {
        this.rightShift();
      }
    });

      this.slider.click((event) => {
        if ($(event.target).is('li img')){
          this.currImgIndex = $(event.target).attr('alt');
          this.imgPreview.removeClass('current');
        $(event.target).addClass('current');
          this.showCurrentImage();
        }
      });
  }

  showCurrentImage(){
    $('#slider div img')
        .attr('src',`${API_URL}${BIG_SIZE}/${IMAGES[this.currImgIndex]}`);
  }

  rightShift(){
    this.currImgIndex = ++this.currImgIndex % IMAGES.length;
    $('.slider-preview').find().removeClass('current');
    $(`#slider-preview li:eq(${this.currImgIndex}) img`).click();
  }


  leftShift(){
    this.currImgIndex = this.currImgIndex === 0 ? IMAGES.length - 1 : --this.currImgIndex;
    $('.slider-preview').find().each((el) => $(el).removeClass('current'));
    $(`#slider-preview li:eq(${this.currImgIndex}) img`).click();
  }
}