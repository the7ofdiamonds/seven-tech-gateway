<script src=<?php echo SEVEN_TECH_URL . "Admin/includes/js/StatusBar.js"; ?> defer></script>
<script src=<?php echo SEVEN_TECH_URL . "Admin/includes/js/Dashboard.js"; ?> defer></script>

<style>
    .dashboard {
        padding-top: 1rem;
    }

    .options {
        display: flex;
        gap: 1.5rem;
        align-items: center;
        justify-content: center;
    }

    .options button h3 {
        margin: 0;
    }

    .dashboard .google-creds {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .dashboard .google-creds-upload,
    .dashboard .google-creds .change {
        display: none;
    }
</style>

<div class="dashboard">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="options" id="options">
        <button id="accounts">
            <h3>Manage Accounts</h3>
        </button>

        <button id="users">
            <h3>Manage Users</h3>
        </button>
    </div>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-status-bar.php'; ?>

    <h2>Google Service Account</h2>

    <div class="google-creds" id="google_creds">
        <h4 id="google_creds_message"></h4>

        <form class="google-creds-upload" id="google_creds_upload">
            <input type="file" name="file" id="file" required>
            <button type="submit" id="submit">Upload</button>
        </form>
    </div>
</div>

<?php

use SEVEN_TECH\Gateway\Admin\AdminAccountManagement;
use SEVEN_TECH\Gateway\Admin\AdminUserManagement;

$accounts_page_url = (new AdminAccountManagement)->page_url;
$users_page_url = (new AdminUserManagement)->page_url;

?>

<script>
    jQuery(document).ready(function($) {
        $("#options button#accounts").on('click', () => {
            window.location.href = "<?php echo esc_url($accounts_page_url); ?>";
        });

        $("#options button#users").on('click', () => {
            window.location.href = "<?php echo esc_url($users_page_url); ?>";
        });
    });
</script>