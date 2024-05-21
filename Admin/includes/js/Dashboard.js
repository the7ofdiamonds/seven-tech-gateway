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

    function uploadFile(file) {
        var formData = new FormData();
        formData.append('action', 'uploadFile');
        formData.append('file', file);

        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                // displayMessage('success', message);
            },
            error: function (xhr, status, error) {
                console.log(error);
                console.log(status);
                console.log(xhr);
                // const errorMessage = `${error}: ${xhr.responseJSON.data}`;

                // $("#google_creds_message").text(errorMessage);

                // displayMessage(status, errorMessage);
            }
        });
    }

    $('#google_creds_upload').submit(function (event) {
        event.preventDefault();
        var fileInput = $('#file')[0].files[0];
        console.log($('#file')[0].files[0]);
        uploadFile(fileInput);
    });
});