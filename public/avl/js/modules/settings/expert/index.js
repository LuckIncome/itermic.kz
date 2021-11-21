$(document).ready(function () {

    $('body').on('click', '.remove--expert', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var section = $(this).attr('data-section');

        $.ajax({
            url: '/admin/settings/sections/' + section + '/expert/' + id,
            type: 'DELETE',
            dataType: 'json',
            data: {_token: $('meta[name="_token"]').attr('content')},
            success: function (data) {
                if (data.success) {
                    $("#expert--item-" + id).remove();
                    messageSuccess(data.success);
                } else {
                    messageError(data.errors);
                }
            }
        });
    });

    $('body').on('click', '.remove--message', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var expert = $(this).attr('data-expert');

        $.ajax({
            url: '/admin/settings/expert/' + expert + '/message/' + id,
            type: 'DELETE',
            dataType: 'json',
            data: {_token: $('meta[name="_token"]').attr('content')},
            success: function (data) {
                if (data.success) {
                    $("#message--item-" + id).remove();
                    messageSuccess(data.success);
                } else {
                    messageError(data.errors);
                }
            }
        });
    });

});
