document.addEventListener('DOMContentLoaded', () => {

    // Hamburger
    const $hamburger = $('.js-header-hamburger');
    const $headerMain = $('.js-header-main');

    $hamburger.on('click', function(e) {
        e.preventDefault();
        $hamburger.toggleClass('is-active');
        $headerMain.stop(true, true).slideToggle();
    });

    if ($(window).width() < 1200) {
        $(document).on('mouseup', function(e) {
            if (
                (!$hamburger.is(e.target) && $hamburger.has(e.target).length === 0) &&
                (!$headerMain.is(e.target) && $headerMain.has(e.target).length === 0)
            ) {
                $hamburger.removeClass('is-active');
                $headerMain.slideUp();
            }
        });
    }

})
