jQuery(document).ready(function ($) {

    $('form#recover_email').submit(function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();

        $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'forgotPassword',
                email: email
            },
            success: function (response) {
                displayMessage('success', response.data);
            },
            error: function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;
                displayMessage(status, errorMessage);
            }
        });
    });
});