jQuery(document).ready(function ($) {
    function findSession(verifier) {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'findSession',
                verifier: verifier
            },
            success: function (response) {  
                const id = response.data.id;
                const username = response.data.username;
                const authorities = response.data.authorities;
                const ip = response.data.ip;
                const login = response.data.login;
                const expiration = response.data.expiration;
                const user_agent = response.data.user_agent;
                const algorithm = response.data.algorithm;
                const access_token = response.data.access_token;
                const refresh_token = response.data.refresh_token;

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

    $('form#find_session').submit(function (event) {
        event.preventDefault();

        const verifier = $('#verifier').val();

        findSession(verifier);
    });
});