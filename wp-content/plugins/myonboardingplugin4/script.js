const dataBox = document.getElementById('data_check').checked;

jQuery(document).ready(function ($) {
    $('#data_check').on('change', function () {
        $.ajax({
            method: "POST",
            url: "http://localhost/wordpress/wp-admin/options-general.php?page=onboarding-elements",
            data: { dataBox }
        });
    });
});

