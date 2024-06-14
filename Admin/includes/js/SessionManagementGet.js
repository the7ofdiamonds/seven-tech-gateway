import { removeSession } from "./SessionManagementRemove.js";

const $ = jQuery;

function getSessions(email) {
    return $.ajax({
        type: 'POST',
        url: 'admin-ajax.php',
        data: {
            action: 'getSessions',
            email: email
        },
        success: function (response) {
            $(".account-id #account_id").text(response.data.id);
            $(".provider-given-id #provider_given_id").text(response.data.provider_given_id);

            $('#sessions').empty();

            var sessions = response.data.sessions;
            var sessionKeys = Object.keys(sessions);

            if (sessionKeys.length > 0) {
                $(".account-status #account_status").text('logged in');

                $('#sessions').css('display', 'flex');

                sessionKeys.forEach(function (token) {
                    var session = sessions[token];
                    var sessionContainer = $(`<div class='session' id='session_${token}'></div>`);

                    const ip = session.ip;
                    const login = new Date(session.login * 1000);
                    const expiration = new Date(session.expiration * 1000);
                    const user_agent = session.user_agent ? session.user_agent : session.ua;
                    const algorithm = session.algorithm ? session.algorithm : 'N/A';
                    const access_token = session.access_token ? session.access_token : 'N/A';
                    const refresh_token = session.refresh_token ? session.refresh_token : 'N/A';

                    var sessionToken = $("<div class='session-token'></div>");
                    $("<h3>token</h3>").appendTo(sessionToken);
                    $("<h4 class='token' id='token'></h4>").text(token).appendTo(sessionToken);
                    sessionToken.appendTo(sessionContainer);

                    var sessionIP = $("<div class='session-ip'></div>");
                    $("<h3>ip</h3>").appendTo(sessionIP);
                    $("<h4 class='ip'></h4>").text(ip).appendTo(sessionIP);
                    sessionIP.appendTo(sessionContainer);

                    var sessionLoginTime = $("<div class='session-login-time'></div>");
                    $("<h3>login time</h3>").appendTo(sessionLoginTime);
                    $("<h4 class='login-time'></h4>").text(login).appendTo(sessionLoginTime);
                    sessionLoginTime.appendTo(sessionContainer);

                    var sessionExpiration = $("<div class='session-expiration'></div>");
                    $("<h3>expiration</h3>").appendTo(sessionExpiration);
                    $("<h4 class='expiration'></h4>").text(expiration).appendTo(sessionExpiration);
                    sessionExpiration.appendTo(sessionContainer);

                    var sessionUserAgent = $("<div class='session-user-agent'></div>");
                    $("<h3>user agent</h3>").appendTo(sessionUserAgent);
                    $("<h4 class='user-agent'></h4>").text(user_agent).appendTo(sessionUserAgent);
                    sessionUserAgent.appendTo(sessionContainer);

                    var sessionAlgorithm = $("<div class='session-algorithm'></div>");
                    $("<h3>Algorithm</h3>").appendTo(sessionAlgorithm);
                    $("<h4 id='algorithm'></h4>").text(algorithm).appendTo(sessionAlgorithm);
                    sessionAlgorithm.appendTo(sessionContainer);

                    var sessionAccessToken = $("<div class='session-access-token'></div>");
                    $("<h3>Access Token</h3>").appendTo(sessionAccessToken);
                    $("<h4 id='access_token'></h4>").text(access_token).appendTo(sessionAccessToken);
                    sessionAccessToken.appendTo(sessionContainer);

                    var sessionRefreshToken = $("<div class='refresh-token'></div>");
                    $("<h3>Refresh Token</h3>").appendTo(sessionRefreshToken);
                    $("<h4 id='refresh_token'></h4>").text(refresh_token).appendTo(sessionRefreshToken);
                    sessionRefreshToken.appendTo(sessionContainer);

                    var sessionRemove = $(`<button class='session-remove' id='${token}'>Remove</button>`);
                    sessionRemove.appendTo(sessionContainer);

                    $('#sessions').append(sessionContainer);
                });
            } else {
                $(".account-status #account_status").text('logged out');
            }
        },
        error: function (xhr, status, error) {
            const errorMessage = `${error}: ${xhr.responseJSON.data}`;
            displayMessage(status, errorMessage);
        }
    });
}

jQuery(document).ready(function ($) {
    $('form#get_sessions').submit(function (event) {
        event.preventDefault();

        const email = $('#get_sessions input[name="email"]#email').val();

        getSessions(email);
    });

    $('#sessions').on('click', '.session-remove', function (event) {
        event.preventDefault();

        const button = $(event.currentTarget);
        const id = $('#session_management_get #account_id').text();
        const verifier = button.attr('id');
        const email = $('#get_sessions input[name="email"]#email').val();

        removeSession(id, verifier, email);
    });
});

export { getSessions };