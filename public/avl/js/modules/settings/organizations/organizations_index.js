$(document).ready(function() {

    $('body').on('click', '.remove--organizations', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var section = $(this).attr('data-section');

        $.ajax({
            url: '/admin/settings/sections/' + section + '/organizations/' + id,
            type: 'DELETE',
            dataType: 'json',
            data : { _token: $('meta[name="_token"]').attr('content')},
            success: function(data) {
                if (data.success) {
                    $("#organizations--item-" + id).remove();
                    messageSuccess(data.success);
                } else {
                    messageError(data.errors);
                }
            }
        });
    });


});
