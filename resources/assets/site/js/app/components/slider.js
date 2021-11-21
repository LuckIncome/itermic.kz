/* Slick.js: https://kenwheeler.github.io/slick/ */

import {icon} from './helpers';

document.addEventListener('DOMContentLoaded', () => {

    // Intro slider
    (function() {
        const $slider = $('.js-intro-slider');

        if ($slider.length) {
            const speed = 700;
            const autoplaySpeed = 7000;
            const $sliderDots = $('.js-intro-slider-dots');
            const updateSliderDots = (currentSlide) => {
                if ($sliderDots.length) {
                    const $currentDot = $('.intro-slider-dots__item[data-slide="'+ currentSlide +'"]');

                    $('.intro-slider-dots__item').removeClass('is-active');
                    $('.intro-slider-dots__progress circle').stop(true).css('stroke-dashoffset', 360);

                    $currentDot.addClass('is-active');
                    $currentDot.find('.intro-slider-dots__progress circle')
                        .css('stroke-dashoffset', 360)
                        .delay(speed)
                        .animate({'stroke-dashoffset': 60}, autoplaySpeed);
                }
            };

            // init
            $slider.on('init', function(event, slick) {
                updateSliderDots(0);
            });

            $slider.slick({
                rows: 0,
                speed: speed,
                fade: true,
                cssEase: 'linear',
                infinite: true,
                arrows: false,
                dots: false,
                autoplay: true,
                autoplaySpeed: autoplaySpeed,
                pauseOnFocus: false,
                pauseOnHover: false,
                adaptiveHeight: true
            });

            $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                updateSliderDots(nextSlide);
            });

            $(document).on('click', '.intro-slider-dots__btn', function () {
                const currentSlide = $(this).parent().data('slide');

                updateSliderDots(currentSlide);
                $slider.slick('slickGoTo', currentSlide);
            });
        }
    })();

    // Useful posts
    (() => {
        $('.js-useful-posts-slider').each(function() {
            const $slider = $(this);

            $slider.slick({
                rows: 0,
                speed: 500,
                slidesToShow: 3,
                swipeToSlide: true,
                infinite: false,
                arrows: false,
                dots: $slider.children().length > 1,
                autoplay: true,
                autoplaySpeed: 5000,
                pauseOnFocus: false,
                pauseOnHover: false,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    })();

    // Reviews
    (() => {
        $('.js-reviews-slider').each(function() {
            const $slider = $(this);
            const $sliderArrows = $slider.closest('.reviews').find('.js-reviews-slider-arrows');

            $slider.slick({
                rows: 0,
                speed: 500,
                slidesToShow: 3,
                swipeToSlide: true,
                infinite: false,
                arrows: true,
                prevArrow: '<div class="slick-prev slick-arrow--primary">'+ icon('icon--barb-arrow', 'icon--barb-arrow-left') +'</div>',
                nextArrow: '<div class="slick-next slick-arrow--primary">'+ icon('icon--barb-arrow', 'icon--barb-arrow-right') +'</div>',
                appendArrows: $sliderArrows,
                dots: false,
                autoplay: true,
                autoplaySpeed: 5000,
                pauseOnFocus: false,
                pauseOnHover: false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    })();

    // Post images
    (() => {
        $('.js-post-images').each(function() {
            const $slider = $(this);

            $slider.slick({
                rows: 0,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                infinite: false,
                arrows: false,
                dots: $slider.children().length > 1
            });
        });
    })();

    // Certificate
    (() => {
        $('.js-certificate-slider-list').each(function() {
            $(this).slick({
                rows: 0,
                speed: 500,
                slidesToShow: 3,
                swipeToSlide: true,
                infinite: false,
                arrows: true,
                prevArrow: '<div class="slick-prev slick-arrow--primary">'+ icon('icon--barb-arrow', 'icon--barb-arrow-left') +'</div>',
                nextArrow: '<div class="slick-next slick-arrow--primary">'+ icon('icon--barb-arrow', 'icon--barb-arrow-right') +'</div>',
                dots: false,
                // autoplay: true,
                // autoplaySpeed: 5000,
                // pauseOnFocus: false,
                // pauseOnHover: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    })();

    // Product
    (() => {
        $('.js-product-slider').each(function() {
            $(this).slick({
                rows: 0,
                speed: 500,
                slidesToShow: 2,
                swipeToSlide: true,
                infinite: false,
                arrows: false,
                dots: true,
                // autoplay: true,
                // autoplaySpeed: 5000,
                // pauseOnFocus: false,
                // pauseOnHover: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    })();

});
