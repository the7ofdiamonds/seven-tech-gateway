jQuery(document).ready(function ($) {
    function findAccount(email) {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'findAccount',
                email: email
            }
        })
            .done(function (response) {
                var id = response.data.id;
                var fullname = `${response.data.first_name} ${response.data.last_name}`;
                var email = response.data.email;

                $('#account_details #account_id').text(id);
                $('#account_details #email').text(email);
                $('#account_details #username').text(response.data.username);
                $('#account_details #full_name').text(fullname);
                $('#account_details #nicename').text(response.data.nicename);
                $('#account_details #phone').text(response.data.phone);
                $('#account_details #provider_given_id').text(response.data.provider_given_id);

                $('#account_details #roles').css('display', 'flex');
                $('#account_details #roles_row').empty();
                $.each(response.data.roles, function (index, role) {
                    var roleTag = $('<h3>', {
                        text: role.display_name
                    });
                    $('#account_details #roles_row').append(roleTag);
                });

                $('#account_details #user_activation_code').text(response.data.user_activation_code);
                $('#account_details #password').text(response.data.password);
                $('#account_details #confirmation_code').text(response.data.confirmation_code);

                var authenticated = response.data.is_authenticated == true ? 'logged in' : 'logged out';
                var unexpired = response.data.is_account_non_expired;
                var unlocked = response.data.is_account_non_locked;
                var credentials = response.data.is_credentials_non_expired;
                var enabled = response.data.is_enabled;

                $('#account_details #account_status').text(authenticated);

                var sessions = response.data.sessions;

                var sessionKeys = null;

                if(sessions != null) {
                    sessionKeys = Object.keys(sessions);
                }

                $('#sessions').empty();

                if (Array.isArray(sessionKeys) && sessionKeys.length > 0) {
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
                }

                $('#subscription #expired').text(unexpired);
                $('#lock_account #locked').text(unlocked);
                $('#password #credentials').text(credentials);
                $('#enable_account #enabled').text(enabled);
            })
            .fail(function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;
                displayMessage(status, errorMessage);
            });
    }

    $('form#find_account').submit(function (event) {
        event.preventDefault();

        var email = $('#find_account input[name="email"]').val();

        findAccount(email);
    });
});
