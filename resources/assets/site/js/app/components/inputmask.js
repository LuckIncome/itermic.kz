/* jquery.inputmask.bundle.js: https://github.com/RobinHerbots/Inputmask */
document.addEventListener('DOMContentLoaded', () => {

    if (jQuery().inputmask) {
        $('.js-input-phone').inputmask('+7 (999) 999-99-99', { showMaskOnHover: false });
    }

});
