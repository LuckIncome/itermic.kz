document.addEventListener('DOMContentLoaded', () => {

    const $form = $('#feedback-form');

    $form.on('submit', function(e) {
        e.preventDefault();

        const $name = $(this.name);
        const $phone = $(this.phone);
        const $submit = $(this).find('.btn[type="submit"]');

        removeFieldError($name);
        removeFieldError($phone);

        $submit.addClass('is-loading');

        $.ajax({
            url: '/feedback',
            type: 'POST',
            async: true,
            dataType: 'json',
            data: {
                _token: $('meta[name="_token"]').attr('content'),
                name: $name.val(),
                phone: $phone.val(),
            },
            success: function(data) {
                if (data.success) {
                    removeFieldError($name);
                    removeFieldError($phone);

                    $form[0].reset();
                    $form.hide().parent().append(`<div class="feedback__form-response">${data.success}</div>`);
                } else {
                    renderFieldError($name);
                    renderFieldError($phone);
                }
            },
            error: function(data) {
                if (data.responseJSON.errors.name) {
                    renderFieldError($name, data.responseJSON.errors.name[0]);
                }
                if (data.responseJSON.errors.phone) {
                    renderFieldError($phone, data.responseJSON.errors.phone[0]);
                }
            },
            complete: function() {
                $submit.removeClass('is-loading');
            }
        });
    });

    function renderFieldError($el, error = '') {
        $el.closest('.feedback__form-field')
            .addClass('has-error')
            .find('.feedback__form-error')
            .html(error);
    }

    function removeFieldError($el) {
        $el.closest('.feedback__form-field')
            .removeClass('has-error')
            .find('.feedback__form-error')
            .html('');
    }

});
