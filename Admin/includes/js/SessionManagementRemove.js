import { getSessions } from "./SessionManagementGet.js";

function removeSession(id, verifier, email) {
    return jQuery.ajax({
        type: 'POST',
        url: 'admin-ajax.php',
        data: {
            action: 'removeSession',
            id: id,
            verifier: verifier
        },
        success: function (response) {
            var message = '';

            if (response.data == true) {
                message = "Session was removed.";
                getSessions(email);
            }

            displayMessage('success', message ? message : response.data);
        },
        error: function (xhr, status, error) {
            const errorMessage = `${error}: ${xhr.responseJSON}`;
            displayMessage(status, errorMessage);
        }
    });
}

jQuery(document).ready(function ($) {
    $('#sessions').on('click', '.session-remove', function (event) {
        event.preventDefault();

        const button = $(event.currentTarget);
        const id = $('#session_management_get #account_id').text();
        const verifier = button.attr('id');
        const email = $('#get_sessions input[name="email"]#email').val();

        removeSession(id, verifier, email);
    });
});

export { removeSession };