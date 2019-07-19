// 'use strict';
const SCROLL_SPEED = 700;
const WINDOW_HEIGHT = $(window).height();


$(() => {
    const $topScrollBtn = $('#top-scroll-btn');
    $('.header__menu > a').click((e) => {
        //e.preventDefault();
        const scrollToElem = $(e.target).attr('href');
        const destVerticalCoordinate = $(scrollToElem).offset().top;
        $('html').animate({scrollTop: destVerticalCoordinate}, SCROLL_SPEED);
    });

    $topScrollBtn.click(() => {
        $('body,html').animate({scrollTop: 0}, SCROLL_SPEED);
    });

    $(window).scroll(() => {
        if ($('body,html').scrollTop() > WINDOW_HEIGHT) {
            $topScrollBtn.removeClass('btn-invisible');
        } else {
            $topScrollBtn.addClass('btn-invisible');
        }
    });

});