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
    <input type="text" name="account_id" id="account_id" disabled>
    <input type="email" name="email" id="email" disabled>
    <h3 id="username"></h3>
    <h3 id="first_name"></h3>
    <h3 id="last_name"></h3>
    <h3 id="nicename"></h3>
    <h3 id="phone"></h3>
    <h3 id="provider_given_id"></h3>
    <h3 id="authenticated"></h3>
    <h3 id="expired"></h3>
    <h3 id="locked"></h3>
    <h3 id="credentials"></h3>
    <h3 id="enabled"></h3>
</div>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Lock Account</td>
                <td><input type="email" name="emailLA" required></td>
                <td><button type="submit">Lock</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Unlock Account</td>
                <td><input type="email" name="emailUA" required></td>
                <td><button type="submit">Unlock</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Remove Account</td>
                <td><input type="email" name="emailRA" required></td>
                <td><button type="submit">Remove</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Delete Account</td>
                <td><input type="email" name="emailDA" required></td>
                <td><button type="submit">Delete</button></td>
            </tr>
        </tbody>
    </table>
</form>

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
                    $('#account #username').text(response.data.username);
                    $('#account #first_name').text(response.data.firstname);
                    $('#account #last_name').text(response.data.lastname);
                    $('#account #nicename').text(response.data.nicename);
                    $('#account #phone').text(response.data.phone);
                    $('#account #provider_given_id').text(response.data.provider_given_id);
                    $('#account #authenticated').text(response.data.is_authenticated);
                    $('#account #expired').text(response.data.is_account_non_expired);
                    $('#account #locked').text(response.data.is_account_non_locked);
                    $('#account #credentials').text(response.data.is_credentials_non_expired);
                    $('#account #enabled').text(response.data.is_enabled);

                    // $('#account #user_roles').empty();
                    // $.each(response.data.roles, function(index, role) {
                    //     var roleTag = $('<h3>', {
                    //         text: role.display_name
                    //     });
                    //     $('#account #user_roles').append(roleTag);
                    // });

                    $('#account input[name="email"]#email').val(response.data.email);

                    // $('#role_select_remove').empty();

                    // $.each(response.data.roles, function(index, role) {
                    //     var option = $('<option>', {
                    //         value: role.name,
                    //         'data-display-name': role.display_name,
                    //         text: role.display_name + ' (' + role.name + ')'
                    //     });
                    //     $('#role_select_remove').append(option);
                    // });
                })
                .fail(function(xhr, status, error) {
                    console.error('Failed to fetch user data:', error);

                    console.log(status);
                    console.log(error);
                });
        }

        $('form#find_account').submit(function(event) {
            event.preventDefault();

            var email = $('#find_account input[name="email"]').val();

            findAccount(email);
        });

        $('form#recover_email').submit(function(event) {
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'forgotPassword',
                    email: email
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
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