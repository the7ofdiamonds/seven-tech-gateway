<link rel="stylesheet" href=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/css/UserManagement.css"; ?>>
<script src=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/js/StatusBar.js"; ?> defer></script>
<script src=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/js/UserManagement.js"; ?> defer></script>

<div class="user-management" id="user_management">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="options" id="options">
        <button id="find_user">
            <h3>Find User</h3>
        </button>

        <button id="update_user">
            <h3>Update User</h3>
        </button>

        <button id="user_role">
            <h3>User Role</h3>
        </button>
    </div>

    <?php include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-status-bar.php'; ?>

    <form method="post" class="find-user" id="find_user">
        <h2>Find User</h2>
        <div class="find-user-submit">
            <input type="email" name="email" placeholder="Email" id="email" required>
            <button type="submit">Find</button>
        </div>
    </form>

    <div class="user-details" id="user_details">
        <div class="user-id">
            <h3>User ID</h3>
            <h4 id="user_id"></h4>
        </div>

        <div class="email">
            <h3>Email</h3>
            <h4 id="email"></h4>
        </div>

        <div class="names">
            <div class="username">
                <h3>Username</h3>
                <h4 id="username"></h4>
            </div>

            <div class="nicename">
                <h3>Nicename</h3>
                <h4 id="nicename"></h4>
            </div>

            <div class="full-name">
                <h3>Full Name</h3>
                <h4 id="full_name"></h4>
            </div>
        </div>

        <div class="phone">
            <h3>Phone</h3>
            <h4 id="phone"></h4>
        </div>

        <div class="roles" id="roles">
            <h3>Roles</h3>
            <div class="roles-row" id="roles_row"></div>
        </div>
    </div>

    <div class="user-management-role" id="user_management_role">
        <form method="post" class="add-user-role" id="add_user_role">
            <h3>Add Role</h3>

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

            <button type="submit">Add</button>
        </form>

        <form method="post" class="remove-user-role" id="remove_user_role">
            <h3>Remove Role</h3>

            <input type="hidden" name="user_roles" id="user_roles">

            <select name="remove_role" id="role_select_remove"></select>

            <input type="hidden" name="display_name_remove" id="display_name_remove">

            <button type="submit">Remove</button>
        </form>
    </div>

    <div class="user-management-update" id="user_management_update">
        <form method="post" class="change-username" id="change_username">
            <h3>Change Username</h3>
            <input type="text" name="username" id="username" placeholder="Username" required>
            <button type="submit">Change</button>
        </form>

        <form method="post" class="change-nicename" id="change_nicename">
            <h3>Change Nicename</h3>
            <input type="text" name="nicename" id="nicename" placeholder="Nicename" required>
            <button type="submit">Change</button>
        </form>

        <form method="post" class="change-nickname" id="change_nickname">
            <h3>Change Nickname</h3>
            <input type="text" name="nickname" id="nickname" placeholder="Nickname" required>
            <button type="submit">Change</button>
        </form>

        <form method="post" class="change-firstname" id="change_firstname">
            <h3>Change First Name</h3>
            <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
            <button type="submit">Change</button>
        </form>

        <form method="post" class="change-lastname" id="change_lastname">
            <h3>Change Last Name</h3>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
            <button type="submit">Change</button>
        </form>

        <form method="post" class="change-phone" id="change_phone">
            <h3>Change Phone</h3>
            <input type="text" name="phone" id="phone" placeholder="Phone" required>
            <button type="submit">Change</button>
        </form>
    </div>
</div>

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