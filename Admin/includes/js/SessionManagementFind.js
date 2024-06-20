import { removeSession } from "./SessionManagementRemove.js";

const $ = jQuery;

function findSession(id, verifier) {
    return $.ajax({
        type: 'POST',
        url: 'admin-ajax.php',
        data: {
            action: 'findSession',
            id: id,
            verifier: verifier
        },
        success: function (response) {
            const id = response.data.id ? response.data.id : 'N/A';
            const username = response.data.username ? response.data.username : 'N/A';
            const authorities = response.data.authorities ? response.data.authorities : 'N/A';
            const ip = response.data.ip;
            const login = response.data.login;
            const expiration = response.data.expiration;
            const user_agent = response.data.user_agent ? response.data.user_agent : response.data.ua;
            const algorithm = response.data.algorithm ? response.data.algorithm : 'N/A';
            const access_token = response.data.access_token ? response.data.access_token : response.data.accessToken;
            const refresh_token = response.data.refresh_token ? response.data.refresh_token : response.data.refreshToken;

            $('#session #account_id').text(id);
            $('#session #provider_given_id').text();
            $('#session #username').text(username);
            $('#session #roles').text(authorities);
            $('#session #ip').text(ip);
            $('#session #login').text(login);
            $('#session #expiration').text(expiration);
            $('#session #user_agent').text(user_agent);
            $('#session #algorithm').text(algorithm);
            $('#session #access_token').text(access_token);
            $('#session #refresh_token').text(refresh_token);
        },
        error: function (xhr, status, error) {
            const errorMessage = `${error}: ${xhr.responseJSON.data}`;
            displayMessage(status, errorMessage);
        }
    });
}

jQuery(document).ready(function ($) {
    $('form#find_session').submit(function (event) {
        event.preventDefault();

        const id = $('#session_management_get #account_id').text();
        const verifier = $('#verifier').val();

        findSession(id, verifier);
    });

    $('button#session_delete_btn').on('click', function () {
        const id = $('#session_management_get #account_id').text();
        const verifier = $('#verifier').val();

        removeSession(id, verifier);
    })
});

export { findSession };