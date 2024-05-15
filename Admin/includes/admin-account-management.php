<style>
    .account .enable-account button.enable-btn,
    .account .enable-account button.disable-btn,
    .account .lock-account button.lock-btn,
    .account .lock-account button.unlock-btn,
    .account .remove-account button.remove-btn,
    .account .remove-account button.recover-btn {
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
                <td>Account Authenticated</td>
                <td>
                    <h3 id="authenticated"></h3>
                </td>
                <td>
                    <!-- Info on user currently logged in if true -->
                </td>
            </tr>
            <tr>
                <form method="post" id="subscription_email">
                    <table>
                        <tbody>
                            <tr>
                                <td>Subscription Expired</td>
                                <td>
                                    <h3 id="expired"></h3>
                                </td>
                                <td>
                                    <button type="submit" class="subscription-btn" id="subscription_btn">Send Subscription Email</button>
                                    <!-- Show roles if they are already subscriped -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
                <form method="post" id="recover_email">
                    <table>
                        <tbody>
                            <tr>
                                <td>Credentials Expired</td>
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
                <form method="post" class="remove-account" id="remove_account">
                    <table>
                        <tbody>
                            <tr>
                                <td>Account Removed</td>
                                <td>
                                    <button type="submit" class="remove-btn" id="remove_btn">Remove</button>
                                    <button type="submit" class="recover-btn" id="recover_btn">Recover</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <!-- <tr>
                <form method="post">
                    <table>
                        <tbody>
                            <tr>
                                <td>Delete Account</td>
                                <td><button type="submit">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr> -->
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
                    $('#account input[name="account_id"]#account_id').val(response.data.id);
                    $('#account input[name="email"]#email').val(response.data.email);
                    $('#account #username').text(response.data.username);
                    $('#account #first_name').text(response.data.firstname);
                    $('#account #last_name').text(response.data.lastname);
                    $('#account #nicename').text(response.data.nicename);
                    $('#account #phone').text(response.data.phone);
                    $('#account #provider_given_id').text(response.data.provider_given_id);

                    var authenticated = response.data.is_authenticated == 1 ? true : false;
                    var expired = response.data.is_account_non_expired == 1 ? true : false;
                    var unlocked = response.data.is_account_non_locked == 1 ? true : false;
                    var credentials = response.data.is_credentials_non_expired == 1 ? true : false;
                    var enabled = response.data.is_enabled == 1 ? true : false;

                    $('#account #authenticated').text(authenticated);

                    $('#account #expired').text(expired);

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



        $('#change_nicename').submit(function(event) {
            event.preventDefault();

            const id = $('#user input[name="user_id"]#user_id').val();
            const nicename = $('#change_nicename #nicename').val();
            const email = $('#user input[name="email"]#email').val();

            $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'changeUserNicename',
                    id: id,
                    nicename: nicename
                },
                success: function(response) {
                    console.log(response.data);
                    getUser(email);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });
    });
</script>