jQuery(document).ready(function ($) {
    function updateSessionLength(length) {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'lengthSession',
                length: length
            },
            success: function (response) {
                displayMessage('success', response.data);
            },
            error: function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;
                displayMessage(status, errorMessage);
            }
        });
    }

    $('form#session_length').submit(function (event) {
        event.preventDefault();

        const length = $('#session_length_select').val();

        updateSessionLength(length);
    });
});