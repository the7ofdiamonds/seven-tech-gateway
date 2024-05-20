jQuery(document).ready(function ($) {
    function areGoogleCredentialsPresent() {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'areGoogleCredentialsPresentAdmin',
            },
            success: function (response) {
                console.log(response.data);
    
                var message = '';
    
                if (response.data == true) {
                    message = 'Google Service Account is valid';
                    $("#google_creds #google_creds_upload").css('display', 'flex');
                }
                displayMessage('success', message);
            },
            error: function (xhr, status, error) {
                console.log('error');
                console.log(xhr.responseJSON);
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;
    
                displayMessage(status, errorMessage);
            }
        });
    }

    areGoogleCredentialsPresent();

    $('form#subscription_email').submit(function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();

        areGoogleCredentialsPresent();
    });

    $("#google_creds #google_creds_upload").css('display', 'flex');

});