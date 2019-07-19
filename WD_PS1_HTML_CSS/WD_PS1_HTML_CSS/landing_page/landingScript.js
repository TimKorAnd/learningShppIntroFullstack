// 'use strict';
const SCROLL_SPEED = 700;
const WINDOW_HEIGHT = $(window).height();


$(() => {
    /*$.fx.off = true;*/
    const $topScrollBtn = $('#top-scroll-btn');
    $('.header__menu > a').click((e) => {
        /*e.preventDefault();*/
        const scrollToElem = $(e.target).attr('href');
        const destVerticalCoordinate = $(scrollToElem).offset().top;
        $('html').animate({scrollTop: destVerticalCoordinate}, {duration:SCROLL_SPEED, queue:'queueMenuScrolling'});
        console.log($(':animated'));
        /*console.log($(':animated').queue('queueMenuScrolling'));*/

        /*if (!$(':animated').length) {
            console.log('no animated');
            $('html').animate({scrollTop: destVerticalCoordinate}, SCROLL_SPEED, 'queueMenuScrolling');
        }
        else {
            console.log('animated');
            $('html').stop(false,false);
        }*/

        /*return false;*/
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
        console.log($(':animated').queue());
        if ($(':animated').queue('queueMenuScrolling') && $(':animated').queue('queueMenuScrolling').length) {
            console.log('animated');
            $('html').stop('queueMenuScrolling',true,false);
        }
    });

});