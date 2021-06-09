jQuery(document).ready(function ($) {

    jQuery('#data_btn').on('click', function () {
        let link = ajax_object.ajax_url;

        $.ajax({
            method: 'GET',
            dataTyte: 'json',
            url: link,
            data: {
                'action': 'handle_html_to',
                'clicked': $('#data_input').val(),
                'expire' : $('#transient-expire').val()
            },
            success: function (res) {
                $('#data-receve-elem').html(res.data);
            }
        });
    });
});



