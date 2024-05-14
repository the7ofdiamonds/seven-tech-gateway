<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailFP'])) {
    $email = $_POST['emailFP'];

    $this->forgotPassword($email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nicename'])) {
    $nicename = $_POST['nicename'];

    $this->changeUserNicename($id, $nicename);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['added_role'])) {
    $addedRole = $_POST['added_role'];
    $addedRoleDisplayName = $_POST['display_name_added'];

    $this->addUserRole($id, $addedRole, $addedRoleDisplayName);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_role'])) {
    $addedRole = $_POST['remove_role'];
    $addedRoleDisplayName = $_POST['display_name_remove'];

    $this->removeUserRole($id, $addedRole, $addedRoleDisplayName);
}
?>
<h1>User Management</h1>

<form method="post" id="find_user">
    <table>
        <tbody>
            <tr>
                <td>Find User</td>
                <td>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="hidden" name="find_user_data" id="find_user_data">
                </td>

                <td><button type="submit">Find</button></td>
            </tr>
        </tbody>
    </table>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['responseData'])) {
    $response = $_POST['responseData']['data'];
    $id = $response['id'];
    $user_roles = $this->getUserRoles($id);
}
?>
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
                <td><input type="text" name="nicename" placeholder="Nicename" required></td>
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
        $('form#find_user').submit(function(event) {
            event.preventDefault();

            var emailGU = $('input#email').val();

            jQuery.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'getUser',
                    emailGU: emailGU
                },
                success: function(response) {
                    $.ajax({
                        type: 'POST',
                        url: 'admin-ajax.php',
                        data: {
                            action: 'getUserRoles',
                            id: response.data['id']
                        },
                        success: function(data) {
                            $.each(data.data, function(index, role) {
                                var option = $('<option>', {
                                    value: role.name,
                                    'data-display-name': role.display_name,
                                    text: role.display_name + ' (' + role.name + ')'
                                });

                                $('#role_select_remove').append(option);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX request failed:', error);
                        }
                    });
                    $('input#find_user_data').val(response.data['id']);

                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });

        $('form#remove_user_role input#user_roles').on('change', function() {
            // Get the value of the input field (assuming it contains JSON data)
            var rolesArray = JSON.parse($(this).val());

            // Clear existing options in the select dropdown
            // $('#role_select_remove').empty();
            console.log(rolesArray);
            // Loop through the array and create options for each role
            $.each(rolesArray, function(index, role) {
                // Create an <option> element with value and display name attributes
                var option = $('<option>', {
                    value: role.name,
                    'data-display-name': role.display_name,
                    text: role.display_name + ' (' + role.name + ')'
                });

                // Append the <option> element to the select dropdown
                $('#role_select_remove').append(option);
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