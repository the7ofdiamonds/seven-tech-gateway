jQuery(document).ready(function ($) {
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

                        var ip = session['ip'];
                        var loginTime = new Date(session['login'] * 1000);
                        var expiration = new Date(session['expiration'] * 1000);
                        var userAgent = session['ua'];

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
                        $("<h4 class='login-time'></h4>").text(loginTime).appendTo(sessionLoginTime);
                        sessionLoginTime.appendTo(sessionContainer);

                        var sessionExpiration = $("<div class='session-expiration'></div>");
                        $("<h3>expiration</h3>").appendTo(sessionExpiration);
                        $("<h4 class='expiration'></h4>").text(expiration).appendTo(sessionExpiration);
                        sessionExpiration.appendTo(sessionContainer);

                        var sessionUserAgent = $("<div class='session-user-agent'></div>");
                        $("<h3>user agent</h3>").appendTo(sessionUserAgent);
                        $("<h4 class='user-agent'></h4>").text(userAgent).appendTo(sessionUserAgent);
                        sessionUserAgent.appendTo(sessionContainer);

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

    $('#find_session #find_session_btn').on('click', function (event) {
        event.preventDefault();

        const email = $('#find_session input[name="email"]#email').val();

        getSessions(email);
    });

    function removeSession(id, verifier, email) {
        return $.ajax({
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

    $('#sessions').on('click', '.session-remove', function (event) {
        event.preventDefault();

        const button = $(event.currentTarget);
        const id = $('.account-id #account_id').text();
        const verifier = button.attr('id');
        const email = $('#find_session input[name="email"]#email').val();

        removeSession(id, verifier, email);
    });
});
