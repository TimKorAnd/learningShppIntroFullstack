'use strict';


$(document).ready(function(){

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

  let currentImgNum = 0;

  showImgPreviews();

  $('html').keydown((e) => {
    if (e.keyCode == DOM_VK_LEFT) {
      leftShift();
    }
  }).keydown((e) => {
    if (e.keyCode == DOM_VK_RIGHT) {
      rightShift();
    }
  });

  function showImgPreviews(){
    const sliderPrev = $('#slider-preview');
    IMAGES.forEach((imgElem) =>{
      const liElem = `<li><img src="${API_URL}${SMALL_SIZE}/${imgElem}"</li>`;
      sliderPrev.append(liElem);
    })

  }

 const slider = new Slider();


});

class Slider {
  constructor(){
    this.imgShown = $('#slider-current');
    this.currImgCounter = 0;
  }
  setEventsToSliderElems(){

  }

  rightShift(){

    IMAGES.map((element) => {});

  }

  leftShift(){

  }
}