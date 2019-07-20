// 'use strict';
const SCROLL_SPEED = 700;
const WINDOW_HEIGHT = $(window).height();



$(() => {
    const $topScrollBtn = $('#top-scroll-btn');
    const $page = $('body,html');
    const stopScroll = () => {
       $page.stop('queueMenuScrolling',true,false);
        // $page.stop('queueTopScrolling',true,false);
    };
    $('.header__menu > a').click((e) => {
        e.stopPropagation();
        stopScroll();
        const scrollToElem = $(e.target).attr('href');
        const destVerticalCoordinate = $(scrollToElem).offset().top - WINDOW_HEIGHT / 2;
        $page.animate({scrollTop: destVerticalCoordinate},
            {duration: SCROLL_SPEED, queue: 'queueMenuScrolling'}).dequeue('queueMenuScrolling');

    });

    $topScrollBtn.click(() => {

        stopScroll();
        $page.animate({scrollTop: 0}, {duration: SCROLL_SPEED, queue:'queueTopScrolling'})
            .dequeue('queueTopScrolling');
    });

    $(window).scroll(() => {
        if ($page.scrollTop() > WINDOW_HEIGHT / 2) {
            $topScrollBtn.removeClass('btn-invisible');
        } else {
            $topScrollBtn.addClass('btn-invisible');
        }
    });

    $(':not(.header__menu__a)').not('.top-scroll-btn').on('click keydown wheel',()=>{
            stopScroll();
    });
});