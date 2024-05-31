jQuery(document).ready(function ($) {

    $('form#delete_account').submit(function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();
        
       $.ajax({
        type: 'POST',
        url: 'admin-ajax.php',
        data: {
            action: 'deleteAccount',
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