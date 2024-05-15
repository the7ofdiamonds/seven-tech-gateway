<h1>User Management</h1>

<form method="post" id="find_user">
    <table>
        <tbody>
            <tr>
                <td>Find User</td>
                <td>
                    <input type="email" name="email" placeholder="Email" required>
                </td>

                <td><button type="submit">Find</button></td>
            </tr>
        </tbody>
    </table>
</form>

<div class="user" id="user">
    <input type="text" name="user_id" id="user_id" disabled>
    <h3 id="first_name"></h3>
    <h3 id="last_name"></h3>
    <h3 id="nicename"></h3>
    <div class="roles-row" id="user_roles"></div>
    <input type="email" name="email" id="email" disabled>
</div>

<form method="post" id="recover_email">
    <table>
        <tbody>
            <tr>
                <td>Send Password Recovery Email</td>
                <td><button type="submit">Send</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post" id="change_nicename">
    <table>
        <tbody>
            <tr>
                <td>Change User Nicename</td>
                <td>
                    <input type="text" name="nicename" id="nicename" placeholder="Nicename" required>
                </td>
                <td><button type="submit">Change</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post" id="add_user_role">
    <table>
        <tbody>
            <tr>
                <td>Add User Role</td>
                <td>
                    <select name="added_role" id="role_select_add">
                        <?php
                        $active_roles = wp_roles()->get_names();

                        foreach ($active_roles as $role => $display_name) : ?>
                            <option value="<?php echo esc_attr($role); ?>" data-display-name="<?php echo esc_attr($display_name); ?>">
                                <?php echo esc_html($display_name); ?> (<?php echo esc_html($role); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="display_name_add" id="display_name_add">
                </td>
                <td><button type="submit">Add</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post" id="remove_user_role">
    <table>
        <tbody>
            <tr>
                <td>Remove User Role</td>
                <td>
                    <input type="hidden" name="user_roles" id="user_roles">

                    <select name="remove_role" id="role_select_remove">
                    </select>

                    <input type="hidden" name="display_name_remove" id="display_name_remove">
                </td>
                <td><button type="submit">Remove</button></td>
            </tr>
        </tbody>
    </table>
</form>

<script>
    jQuery(document).ready(function($) {
        function getUser(email) {
            return $.ajax({
                    type: 'POST',
                    url: 'admin-ajax.php',
                    data: {
                        action: 'getUser',
                        email: email
                    }
                })
                .done(function(response) {
                    $('#user input[name="user_id"]#user_id').val(response.data['id']);
                    $('#user #first_name').text(response.data['firstname']);
                    $('#user #last_name').text(response.data['lastname']);
                    $('#user #nicename').text(response.data['nicename']);

                    $('#user #user_roles').empty();
                    $.each(response.data['roles'], function(index, role) {
                        var roleTag = $('<h3>', {
                            text: role.display_name
                        });
                        $('#user #user_roles').append(roleTag);
                    });

                    $('#user input[name="email"]#email').val(response.data['email']);

                    $('#role_select_remove').empty();

                    $.each(response.data['roles'], function(index, role) {
                        var option = $('<option>', {
                            value: role.name,
                            'data-display-name': role.display_name,
                            text: role.display_name + ' (' + role.name + ')'
                        });
                        $('#role_select_remove').append(option);
                    });
                })
                .fail(function(xhr, status, error) {
                    console.error('Failed to fetch user data:', error);
                });
        }

        $('form#find_user').submit(function(event) {
            event.preventDefault();

            var email = $('#find_user input[name="email"]').val();

            getUser(email);
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

        $('form#add_user_role').submit(function(event) {
            event.preventDefault();

            const id = $('#user input[name="user_id"]#user_id').val();
            const role = $('#add_user_role #role_select_add').val();
            const displayName = $('#add_user_role #display_name_add').val();
            const email = $('#user input[name="email"]#email').val();

            jQuery.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'addUserRole',
                    id: id,
                    added_role: role,
                    display_name_added: displayName
                },
                success: function(response) {
                    console.log(response);
                    getUser(email);

                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });

        $('form#remove_user_role').submit(function(event) {
            event.preventDefault();

            const id = $('#user input[name="user_id"]#user_id').val();
            const role = $('#role_select_remove').val();
            const displayName = $('#display_name_remove').val();
            const email = $('#user input[name="email"]#email').val();

            jQuery.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'removeUserRole',
                    id: id,
                    remove_role: role,
                    display_name_remove: displayName
                },
                success: function(response) {
                    console.log(response);
                    getUser(email);

                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });
    });
</script>

<script>
    document.getElementById('add_user_role').addEventListener('submit', function(event) {
        var selectedOption = document.getElementById('role_select_add').options[document.getElementById('role_select_add').selectedIndex];
        var displayName = selectedOption.getAttribute('data-display-name');
        document.getElementById('display_name_add').value = displayName;
    });
</script>

<script>
    document.getElementById('remove_user_role').addEventListener('submit', function(event) {
        var selectedOption = document.getElementById('role_select_remove').options[document.getElementById('role_select_remove').selectedIndex];
        var displayName = selectedOption.getAttribute('data-display-name');
        document.getElementById('display_name_remove').value = displayName;
    });
</script>