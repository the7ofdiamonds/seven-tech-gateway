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

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-status-bar.php'; ?>

    <form class="google-creds" id="google_creds">
        <h2>Google Service Account</h2>

        <div class="google-creds-upload" id="google_creds_upload">
            <input type="email" name="email" placeholder="Email" id="email" required>
            <button type="submit">Find</button>
        </div>

        <div class="google-creds-uploaded" id="google_creds_uploaded">
            <h4 id="google_creds_message"></h4>
            <button>Change</button>
        </div>
    </form>
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

        function areGoogleCredentialsPresent() {
            return $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'areGoogleCredentialsPresentAdmin',
                },
                done: function(response) {
                    var message = '';

                    if (response.data == true) {
                        var message = 'Google Service Account is valid';
                    }
console.log(response);
                    displayMessage('success', message);
                },
                fail: function(xhr, status, error) {
                    console.log('error');
                    console.log(xhr.responseJSON);
                    const errorMessage = `${error}: ${xhr.responseJSON.data}`;

                    displayMessage(status, errorMessage);
                }
            });
        }

        areGoogleCredentialsPresent();

        $('form#subscription_email').submit(function(event) {
            event.preventDefault();

            const email = $('#find_account input[name="email"]#email').val();

            areGoogleCredentialsPresent();
        });

        $("#google_creds #google_creds_upload").css('display', 'flex');

        $("#google_creds #google_creds_upload").css('display', 'flex');
    });
</script>