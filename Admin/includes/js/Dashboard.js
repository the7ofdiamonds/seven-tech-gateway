jQuery(document).ready(function ($) {
    function areGoogleCredentialsPresent() {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'areGoogleCredentialsPresentAdmin',
            },
            success: function (response) {
                var message = '';

                if (response.data == true) {
                    message = 'Google Service Account is valid';

                    $("#google_creds_message").text(message);
                }

                displayMessage('success', message);
            },
            error: function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;

                $("#google_creds_message").text(errorMessage);

                displayMessage(status, errorMessage);
            }
        });
    }

    areGoogleCredentialsPresent();

    function uploadFile() {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'uploadFile',

            },
            contentType: false,
            processData: false,
            success: function (response) {
                var message = '';

                if (response.data == true) {
                    message = 'Google Service Account is valid';

                    $("#google_creds_message").text(message);
                }

                displayMessage('success', message);
            },
            error: function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;

                $("#google_creds_message").text(errorMessage);

                displayMessage(status, errorMessage);
            }
        });
    }

    $('form#google_creds_upload').submit(function (event) {
        event.preventDefault();
        var fileInput = $('#fileInput')[0].files[0];
        // var formData = new FormData();
        // formData.append('file', fileInput);

        uploadFile();
    });
});