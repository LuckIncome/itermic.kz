window.addEventListener('load', (event) => {

    const $introInner = $('.js-intro-inner');
    const containerWidth = 1200;
    const windowWidth = $(window).width();
    const setIntroInnerWidth = () => {
        const windowWidth = $(window).width();
        const containerOffset = (windowWidth - containerWidth) / 2;

        $introInner.css('width', windowWidth - containerOffset);
    };

    if (windowWidth >= 1440 && $introInner.length) {
        setIntroInnerWidth();
        $(window).on('resize', () => setIntroInnerWidth());
    }

});
