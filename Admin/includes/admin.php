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

    .account-management#account_management,
    .user-management#user_management {
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