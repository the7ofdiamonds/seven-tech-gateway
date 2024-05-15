<style>
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
    <table>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="account_id" id="account_id" disabled>
                </td>
                <td>
                    <h3 id="provider_given_id"></h3>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="email" name="email" id="email" disabled>
                </td>
                <td>
                    <h3 id="phone"></h3>
                </td>
            </tr>
            <tr>
                <td>
                    <h3 id="username"></h3>
                </td>
                <td>
                    <h3 id="nicename"></h3>
                </td>
            </tr>
            <tr>
                <td>
                    <h3 id="first_name"></h3>
                </td>
                <td>
                    <h3 id="last_name"></h3>
                </td>
            </tr>
            <tr>
                <td>Account Status</td>
                <td>
                    <h3 id="authenticated"></h3>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="account-status">

                    </div>
                    <!-- Info on user currently logged in if true -->
                </td>
            </tr>
            <tr>
                <form method="post" class="subscription-email" id="subscription_email">
                    <table>
                        <tbody>
                            <tr>
                                <td>Subscription Current</td>
                                <td>
                                    <h3 id="expired"></h3>
                                </td>
                                <td>
                                    <button type="submit" class="subscription-btn" id="subscription_btn">Send Subscription Email</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
                <div class="roles" id="roles">
                    <h3>Roles</h3>
                    <div class="roles-row" id="roles_row"></div>
                </div>
            </tr>
            <tr>
                <form method="post" class="recover-email" id="recover_email">
                    <table>
                        <tbody>
                            <tr>
                                <td>Credentials Current</td>
                                <td>
                                    <h3 id="credentials"></h3>
                                </td>
                                <td><button type="submit" class="recover-btn" id="recover_btn">Send Recovery Email</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
                <form method="post" class="lock-account" id="lock_account">
                    <table>
                        <tbody>
                            <tr>
                                <td>Account Unlocked</td>
                                <td>
                                    <h3 id="locked"></h3>
                                </td>
                                <td>
                                    <button type="submit" class="lock-btn" id="lock_btn">Lock</button>
                                    <button type="submit" class="unlock-btn" id="unlock_btn">unlock</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
                <form method="post" class="enable-account" id="enable_account">
                    <table>
                        <tbody>
                            <tr>
                                <td>Account Enabled</td>
                                <td>
                                    <h3 id="enabled"></h3>
                                </td>
                                <td>
                                    <button type="submit" class="enable-btn" id="enable_btn">enable</button>
                                    <button type="submit" class="disable-btn" id="disable_btn">disable</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
                <form method="post" class="delete-account" id="delete_account">
                    <table>
                        <tbody>
                            <tr>
                                <td>Delete Account</td>
                                <td><button type="submit" class="delete-btn" id="delete_btn">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
        </tbody>
    </table>
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

                    $('#account input[name="account_id"]#account_id').val(id);
                    $('#account input[name="email"]#email').val(response.data.email);
                    $('#account #username').text(response.data.username);
                    $('#account #first_name').text(response.data.firstname);
                    $('#account #last_name').text(response.data.lastname);
                    $('#account #nicename').text(response.data.nicename);
                    $('#account #phone').text(response.data.phone);
                    $('#account #provider_given_id').text(response.data.provider_given_id);

                    var authenticated = response.data.is_authenticated == 1 ? 'logged in' : 'logged out';

                    var unexpired = response.data.is_account_non_expired == 1 ? true : false;
                    var unlocked = response.data.is_account_non_locked == 1 ? true : false;
                    var credentials = response.data.is_credentials_non_expired == 1 ? true : false;
                    var enabled = response.data.is_enabled == 1 ? true : false;

                    $('#account #authenticated').text(authenticated);
                    // if (authenticated) {
                        $.ajax({
                                type: 'POST',
                                url: 'admin-ajax.php',
                                data: {
                                    action: 'getAccountStatus',
                                    id: id
                                }
                            })
                            .done(function(status) {
                                console.log(status.data[0]);
                                // $('#account #roles_row').empty();
                                // $.each(user.data, function(index, role) {
                                //     var roleTag = $('<h3>', {
                                //         text: role.display_name
                                //     });
                                //     $('#account #roles_row').append(roleTag);
                                // });
                            })
                            .fail(function(xhr, status, error) {
                                console.error('Failed to fetch user data:', error);
                            });
                    // }

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
                        $('#account #delete_account').css('display', 'block');
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