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
                var fullname = `${response.data.firstname} ${response.data.lastname}`;

                $('#account #account_id').text(id);
                $('#account #email').text(response.data.email);
                $('#account #username').text(response.data.username);
                $('#account #full_name').text(fullname);
                $('#account #nicename').text(response.data.nicename);
                $('#account #phone').text(response.data.phone);
                $('#account #provider_given_id').text(response.data.provider_given_id);

                $('#account #roles').css('display', 'flex');
                $('#account #roles_row').empty();
                $.each(response.data.roles, function(index, role) {
                    var roleTag = $('<h3>', {
                        text: role.display_name
                    });
                    $('#account #roles_row').append(roleTag);
                });

                var authenticated = response.data.is_authenticated == 1 ? 'logged in' : 'logged out';

                var unexpired = response.data.is_account_non_expired == 1 ? true : false;
                var unlocked = response.data.is_account_non_locked == 1 ? true : false;
                var credentials = response.data.is_credentials_non_expired == 1 ? true : false;
                var enabled = response.data.is_enabled == 1 ? true : false;

                $('#account #authenticated').text(authenticated);
                if (authenticated) {
                    $.ajax({
                        type: 'POST',
                        url: 'admin-ajax.php',
                        data: {
                            action: 'getAccountStatus',
                            id: id
                        }
                    })
                        .done(function (status) {
                            $('#sessions').empty();

                            var sessions = status.data[0];
                            var sessionKeys = Object.keys(sessions);
                            var numberOfSessions = sessionKeys.length;

                            if (numberOfSessions > 0) {
                                $('#sessions').css('display', 'flex');
                            }

                            sessionKeys.forEach(function (token) {
                                var session = sessions[token];
                                var sessionContainer = $(`<div class='session' id='session_${token}'></div>`);

                                var ip = session['ip'];
                                var loginTime = session['login'];
                                var expiration = session['expiration'];
                                var userAgent = session['ua'];

                                var sessionToken = $("<div class='session-token'></div>");
                                $("<h3>token</h3>").appendTo(sessionToken);
                                $("<h4 class='token'></h4>").text(token).appendTo(sessionToken);
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

                                $('#sessions').append(sessionContainer);
                            });

                        })
                        .fail(function (xhr, status, error) {
                            console.error('Failed to fetch user data:', error);
                        });
                }

                $('#account_management #expired').text(unexpired);

                $('#account_management #locked').text(unlocked);
                if (unlocked) {
                    $('#account_management #lock_account #lock_btn').css('display', 'block');
                } else {
                    $('#account_management #lock_account #unlock_btn').css('display', 'block');
                }

                $('#account_management #credentials').text(credentials);

                $('#account_management #enabled').text(enabled);
                if (enabled) {
                    $('#account_management #enable_account #disable_btn').css('display', 'block');
                } else {
                    $('#account_management #enable_account #enable_btn').css('display', 'block');
                }

                if (unlocked == false && enabled == false) {
                    $('#account_management #delete_account').css('display', 'flex');
                }
            })
            .fail(function (xhr, status, error) {
                console.error('Failed to fetch user data:', error);
            });
    }

    $('form#find_account').submit(function (event) {
        event.preventDefault();

        var email = $('#find_account input[name="email"]').val();

        findAccount(email);
    });
});
