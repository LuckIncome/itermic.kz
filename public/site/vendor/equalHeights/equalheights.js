(function ($) {
    $.fn.equalHeights = function () {
        var $items = $(this);

        if ($items.length) {
            equalize();

            $(window).on('resize', function () {
                equalize();
            });
        }

        function equalize() {
            $items.height('initial');
            var maxH = $items.eq(0).height();

            $items.each(function () {
                maxH = ($(this).height() > maxH) ? $(this).height() : maxH;
            });

            $items.height(maxH);
        }
    };
})(jQuery);
