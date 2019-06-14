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
    this.bigImgSrcs = [];
    this.bigImgElem = $('#slider-current img')
    this.showImgPreviews();
    this.imgPreviewElems = $('#slider-preview li');
    this.setEventsToSliderElems();
    $('#slider-preview :first').addClass('current');
  }


  showImgPreviews(){
    const sliderPrev = $('#slider-preview');
    IMAGES.forEach((imgElem, i) =>{
      const liDOMElem = $('<li></li>');
      const imgDOMElem = $('<img>').attr('src',`${API_URL}${SMALL_SIZE}/${imgElem}`).attr('alt',i);
      this.createBigImgSrcMap(imgElem);
      liDOMElem.append(imgDOMElem);
      sliderPrev.append(liDOMElem);
    })
  }

  /* create img src associated map */
  createBigImgSrcMap(imgElem) {
    this.bigImgSrcs[`${API_URL}${SMALL_SIZE}/${imgElem}`] = `${API_URL}${BIG_SIZE}/${imgElem}`;
  }

  setEventsToSliderElems(){
    $('html').keydown((e) => {
      if (e.keyCode === DOM_VK_LEFT) {
        this.changeCurrentImgs(this.getCurrForLeftShift());
      }
    else
      if (e.keyCode === DOM_VK_RIGHT) {
        this.changeCurrentImgs(this.getCurrForRightShift());
      }
    });

      $('#slider-preview li img').click((event) => {
        this.changeCurrentImgs($(event.target).parent())
      });
  }

  changeCurrentImgs(previewElem){
    this.setCurrPreviewElem(previewElem);
    this.showBigImageByPreviewImgSrc(previewElem.children().attr('src'));
  }

  setCurrPreviewElem(elem) {
    this.imgPreviewElems.removeClass('current');
    $(elem).addClass('current');
  }

  showBigImageByPreviewImgSrc(previewImgSrc){
    this.bigImgElem.attr('src', `${this.bigImgSrcs[previewImgSrc]}`);
  }

  getCurrForRightShift(){
    const $currPreviewElem = $('#slider-preview .current');
    const $nextPreviewElem = ($currPreviewElem.is(':last-child')) ? $('#slider-preview  li:first') :
        $currPreviewElem.next('li');
    return $nextPreviewElem;
  }

  getCurrForLeftShift(){
    const $currPreviewElem = $('#slider-preview .current');
    const $nextPreviewElem = ($currPreviewElem.is(':first-child')) ? $('#slider-preview  li:last') :
        $currPreviewElem.prev('li');
    return $nextPreviewElem;
  }
}