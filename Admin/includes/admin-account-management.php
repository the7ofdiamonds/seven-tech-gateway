<style>
    .account {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 1rem;
    }

    .account h3,
    .account h4 {
        margin: 0;
    }

    .account .ids,
    .account .contact,
    .account .names {
        display: flex;
        gap: 1rem;
    }

    .account .full-name {
        display: flex;
        gap: 1rem;
    }

    .account .account-status {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .account .account-status .account-status-label {
        display: flex;
        flex-direction: row;
        gap: 1.5rem;
    }

    .account .account-status .sessions {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .account .account-status .sessions .session {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        padding: 1rem;
        background-color: white;
    }

    .account .account-status .sessions .session .session-token,
    .account .account-status .sessions .session .session-ip,
    .account .account-status .sessions .session .session-login-time,
    .account .account-status .sessions .session .session-expiration,
    .account .account-status .sessions .session .session-user-agent {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .account .subscription-email,
    .account .roles,
    .account .recover-email,
    .account .lock-account,
    .account .enable-account {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .account .delete-account {
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .account .roles,
    .account .roles-row {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .account .enable-account button.enable-btn,
    .account .enable-account button.disable-btn,
    .account .lock-account button.lock-btn,
    .account .lock-account button.unlock-btn,
    .account .delete-account {
        display: none;
    }
</style>

<h1>Account Management</h1>

<form method="post" id="find_account">
    <table>
        <tbody>
            <tr>
                <td>Find Account</td>
                <td>
                    <input type="email" name="email" placeholder="Email" required>
                </td>

                <td><button type="submit">Find</button></td>
            </tr>
        </tbody>
    </table>
</form>

<div class="account" id="account">

    <div class="ids" id="ids">
        <div class="account-id">
            <h3>account id</h3>
            <input type="text" name="account_id" id="account_id" disabled>
        </div>
        <div class="provider-given-id">
            <h3>provider given id</h3>
            <h4 id="provider_given_id"></h4>
        </div>
    </div>

    <div class="contact" id="contact">
        <div class="email">
            <h3>email</h3>
            <input type="email" name="email" id="email" disabled>
        </div>
        <div class="phone">
            <h3>phone</h3>
            <h4 id="phone"></h4>
        </div>
    </div>

    <div class="names">
        <div class="username">
            <h3>username</h3>
            <h4 id="username"></h4>
        </div>
        <div class="nicename">
            <h3>nicename</h3>
            <h4 id="nicename"></h4>
        </div>
    </div>

    <div class="full-name">
        <h3>fullname</h3>
        <h4 id="full_name"></h4>
    </div>

    <div class="account-status">
        <div class="account-status-label">
            <h3>Account Status</h3>
            <h4 id="authenticated"></h4>
        </div>
        <div class="sessions" id="sessions"></div>
    </div>

    <form method="post" class="subscription-email" id="subscription_email">
        <h3>Subscription Current</h3>
        <h3 id="expired"></h3>
        <button type="submit" class="subscription-btn" id="subscription_btn">Send Subscription Email</button>
    </form>

    <div class="roles" id="roles">
        <h3>Roles</h3>
        <div class="roles-row" id="roles_row"></div>
    </div>

    <form method="post" class="recover-email" id="recover_email">
        <h3>Credentials Current</h3>
        <h3 id="credentials"></h3>
        <button type="submit" class="recover-btn" id="recover_btn">Send Recovery Email</button>
    </form>

    <form method="post" class="lock-account" id="lock_account">
        <h3>Account Unlocked</h3>
        <h3 id="locked"></h3>
        <button type="submit" class="lock-btn" id="lock_btn">Lock</button>
        <button type="submit" class="unlock-btn" id="unlock_btn">unlock</button>
    </form>

    <form method="post" class="enable-account" id="enable_account">
        <h3>Account Enabled</h3>
        <h3 id="enabled"></h3>
        <button type="submit" class="enable-btn" id="enable_btn">enable</button>
        <button type="submit" class="disable-btn" id="disable_btn">disable</button>
    </form>

    <form method="post" class="delete-account" id="delete_account">
        <h3>Delete Account</h3>
        <button type="submit" class="delete-btn" id="delete_btn">Delete</button>
    </form>
</div>

<script>
    jQuery(document).ready(function($) {
        function findAccount(email) {
            return $.ajax({
                    type: 'POST',
                    url: 'admin-ajax.php',
                    data: {
                        action: 'findAccount',
                        email: email
                    }
                })
                .done(function(response) {
                    var id = response.data.id;
                    var fullname = `${response.data.firstname} ${response.data.lastname}`;
console.log(response.data);
                    $('#account input[name="account_id"]#account_id').val(id);
                    $('#account input[name="email"]#email').val(response.data.email);
                    $('#account #username').text(response.data.username);
                    $('#account #full_name').text(fullname);
                    $('#account #nicename').text(response.data.nicename);
                    $('#account #phone').text(response.data.phone);
                    $('#account #provider_given_id').text(response.data.provider_given_id);

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
                            .done(function(status) {
                                $('#sessions').empty();

                                var sessions = status.data[0];
                                var sessionKeys = Object.keys(sessions);
                                var numberOfSessions = sessionKeys.length;

                                sessionKeys.forEach(function(token) {
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
                            .fail(function(xhr, status, error) {
                                console.error('Failed to fetch user data:', error);
                            });
                    }

                    $('#account #expired').text(unexpired);

                    $('#account #locked').text(unlocked);
                    if (unlocked) {
                        $('#account #lock_account #lock_btn').css('display', 'block');
                    } else {
                        $('#account #lock_account #unlock_btn').css('display', 'block');
                    }

                    $('#account #credentials').text(credentials);

                    $('#account #enabled').text(enabled);
                    if (enabled) {
                        $('#account #enable_account #disable_btn').css('display', 'block');
                    } else {
                        $('#account #enable_account #enable_btn').css('display', 'block');
                    }

                    if (unlocked == false && enabled == false) {
                        $('#account #delete_account').css('display', 'flex');
                    }

                    if (unexpired) {
                        $.ajax({
                                type: 'POST',
                                url: 'admin-ajax.php',
                                data: {
                                    action: 'getUserRoles',
                                    id: id
                                }
                            })
                            .done(function(user) {
                                $('#account #roles_row').empty();
                                $.each(user.data, function(index, role) {
                                    var roleTag = $('<h3>', {
                                        text: role.display_name
                                    });
                                    $('#account #roles_row').append(roleTag);
                                });
                            })
                            .fail(function(xhr, status, error) {
                                console.error('Failed to fetch user data:', error);
                            });
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error('Failed to fetch user data:', error);
                });
        }

        $('form#find_account').submit(function(event) {
            event.preventDefault();

            var email = $('#find_account input[name="email"]').val();

            findAccount(email);
        });
    });
</script>