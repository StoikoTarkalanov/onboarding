jQuery(document).ready(function ($) {

    $('#data_check').on('change', function () {
        var ischecked = $('#data_check').prop('checked');
        let link = ajax_object.ajax_url;
        // console.log(ischecked);

        $.ajax({
            method: 'POST',
            url: link,
            data: {
                'action': 'handle_with_options_api',
                'box': `${ischecked}`
            },
        });
    });
});
