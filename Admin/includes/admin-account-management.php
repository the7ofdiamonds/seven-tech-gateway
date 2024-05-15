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
                <td>
                    <input type="email" name="email" id="email" disabled>
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
                <td>
                    <h3 id="phone"></h3>
                </td>
            </tr>
            <tr>
                <form action="">
                    <table>
                        <tbody>
                            <tr>
                                <td>Account Authenticated</td>
                                <td>
                                    <h3 id="authenticated"></h3>
                                </td>
                                <td><button type="submit" id="auth-btn">Auth</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
                <form action="">
                    <table>
                        <tbody>
                            <tr>
                                <td>Account Expired</td>
                                <td>
                                    <h3 id="expired"></h3>
                                </td>
                                <td><button>Expired</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
                <form action="">
                    <table>
                        <tbody>
                            <tr>
                                <td>Expired Credentials</td>
                                <td>
                                    <h3 id="credentials"></h3>
                                </td>
                                <td><button>Cred</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
                <form action="">
                    <table>
                        <tbody>
                            <tr>
                                <td>Account Enabled</td>
                                <td>
                                    <h3 id="enabled"></h3>
                                </td>
                                <td><button>enabled</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
                <table>
                    <tbody>
                        <tr>
                            <form method="post">
                                <td>Account Locked</td>
                                <td>
                                    <h3 id="locked"></h3>
                                </td>
                                <td><button type="submit" id="lock-btn">Lock</button></td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
                <form method="post">
                    <table>
                        <tbody>
                            <tr>
                                <td>Remove Account</td>
                                <td><button type="submit">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tr>
            <tr>
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
                    var locked = response.data.is_account_non_locked == 1 ? true : false;
                    var credentials = response.data.is_credentials_non_expired == 1 ? true : false;
                    var enabled = response.data.is_enabled == 1 ? true : false;

                    $('#account #authenticated').text(authenticated);
                    $('#account #expired').text(expired);
                    $('#account #locked').text(locked);
                    $('#account #credentials').text(credentials);
                    $('#account #enabled').text(enabled);
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