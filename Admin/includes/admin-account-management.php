<link rel="stylesheet" href=<?php echo SEVEN_TECH_URL . "Admin/includes/css/AccountManagement.css"; ?>>
<script src=<?php echo SEVEN_TECH_URL . "Admin/includes/js/StatusBar.js"; ?> defer></script>
<script src=<?php echo SEVEN_TECH_URL . "Admin/includes/js/AccountManagement.js"; ?> defer></script>

<div class="account-management" id="account_management">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="options" id="options">
        <button id="create_account">
            <h3>Create Account</h3>
        </button>

        <button id="find_account">
            <h3>Find Account</h3>
        </button>

        <button id="update_account">
            <h3>Update Account</h3>
        </button>

        <button id="delete_account">
            <h3>Delete Account</h3>
        </button>
    </div>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-status-bar.php'; ?>
    
    <?php include_once SEVEN_TECH . 'Admin/includes/admin-create-account.php'; ?>

    <form method="post" class="find-account" id="find_account">
        <h2>Find Account</h2>
        <div class="find-account-submit">
            <input type="email" name="email" placeholder="Email" id="email" required>
            <button type="submit">Find</button>
        </div>
    </form>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-account-details.php'; ?>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-account-update.php'; ?>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-account-delete.php'; ?>
</div>