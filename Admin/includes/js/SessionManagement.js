jQuery(document).ready(function ($) {
    function getSessions(id) {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'getSessions',
                id: id
            },
            success: function (response) {
                var sessions = response.data;
                var sessionKeys = Object.keys(sessions);

                if (sessionKeys.length > 0) {
                    $('#sessions').css('display', 'flex');

                    $('#sessions').empty();

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
                }
            },
            error: function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;

                displayMessage(status, errorMessage);
            }
        });
    }

    function removeSession(id, verifier) {
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
                    getSessions(id);
                }

                displayMessage('success', message ? message : response.data);
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                const errorMessage = `${error}: ${xhr.responseJSON}`;

                displayMessage(status, errorMessage);
            }
        });
    }

    $('#sessions').on('click', '.session-remove', function (event) {
        event.preventDefault();

        const button = $(event.currentTarget);
        const id = $('#account #account_id').text();
        const verifier = button.attr('id');

        removeSession(id, verifier);
    });
});
