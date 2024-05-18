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
    <h1>SEVEN TECH GATEWAY</h1>

    <div class="options" id="options">
        <button id="accounts">
            <h3>Manage Accounts</h3>
        </button>

        <button id="users">
            <h3>Manage Users</h3>
        </button>
    </div>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-account-management.php'; ?>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-user-management.php'; ?>
</div>

<script>
    jQuery(document).ready(function($) {
        $("#options button#accounts").on('click', () => {
            $("#account_management").css('display', 'flex');
            $("#user_management").css('display', 'none');
        });

        $("#options button#users").on('click', () => {
            $("#account_management").css('display', 'none');
            $("#user_management").css('display', 'flex');
        });
    });
</script>