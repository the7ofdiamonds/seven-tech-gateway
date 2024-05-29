jQuery(document).ready(function ($) {
    $("#options button#create_account").on('click', () => {
        $("#account_management form#create_account").css('display', 'flex');
        $("form#find_account").css('display', 'none');
        $("div#account").css('display', 'none');
        $("form#subscription_email").css('display', 'none');
        $("form#recover_email").css('display', 'none');
        $("form#lock_account").css('display', 'none');
        $("form#enable_account").css('display', 'none');
        $("form#delete_account").css('display', 'none');
    });

    $("#options button#find_account").on('click', () => {
        $("#account_management form#create_account").css('display', 'none');
        $("form#find_account").css('display', 'flex');
        $("div#account").css('display', 'flex');
        $("form#subscription_email").css('display', 'none');
        $("form#recover_email").css('display', 'none');
        $("form#lock_account").css('display', 'none');
        $("form#enable_account").css('display', 'none');
        $("form#delete_account").css('display', 'none');
    });

    $("#options button#update_account").on('click', () => {
        $("#account_management form#create_account").css('display', 'none');
        $("form#find_account").css('display', 'flex');
        $("div#account").css('display', 'none');
        $("form#subscription_email").css('display', 'flex');
        $("form#recover_email").css('display', 'flex');
        $("form#lock_account").css('display', 'flex');
        $("form#enable_account").css('display', 'flex');
        $("form#delete_account").css('display', 'none');
    });

    $("#options button#delete_account").on('click', () => {
        $("#account_management form#create_account").css('display', 'none');
        $("form#find_account").css('display', 'flex');
        $("div#account").css('display', 'none');
        $("form#subscription_email").css('display', 'none');
        $("form#recover_email").css('display', 'none');
        $("form#lock_account").css('display', 'none');
        $("form#enable_account").css('display', 'none');
        $("form#delete_account").css('display', 'flex');
    });

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

                $('#account #account_id').text(id);
                $('#account #email').text(email);
                $('#account #username').text(response.data.username);
                $('#account #full_name').text(fullname);
                $('#account #nicename').text(response.data.nicename);
                $('#account #phone').text(response.data.phone);
                $('#account #provider_given_id').text(response.data.provider_given_id);

                $('#account #roles').css('display', 'flex');
                $('#account #roles_row').empty();
                $.each(response.data.roles, function (index, role) {
                    var roleTag = $('<h3>', {
                        text: role.display_name
                    });
                    $('#account #roles_row').append(roleTag);
                });

                var authenticated = response.data.is_authenticated;
                var unexpired = response.data.is_account_non_expired;
                var unlocked = response.data.is_account_non_locked;
                var credentials = response.data.is_credentials_non_expired;
                var enabled = response.data.is_enabled;

                $('#account #authenticated').text(authenticated);

                var sessions = response.data.sessions;
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
                // const errorMessage = `${error}: ${xhr.responseJSON.data}`;
console.log(xhr);
console.log(status);
console.log(error);
                // displayMessage(status, errorMessage);
            });
    }

    $('form#find_account').submit(function (event) {
        event.preventDefault();

        var email = $('#find_account input[name="email"]').val();

        findAccount(email);
    });
});
