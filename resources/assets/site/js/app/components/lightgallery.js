document.addEventListener('DOMContentLoaded', () => {

    $('.js-lg').each(function() {
        const $gallery = $(this);

        $gallery.lightGallery({
            selector: '[data-lg]',
            download: !$gallery.hasClass('js-lg-off-download'),
            counter: !$gallery.hasClass('js-lg-off-counter'),
            zoom: !$gallery.hasClass('js-lg-off-zoom')
        });
    });

});
