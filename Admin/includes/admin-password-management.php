<script src=<?php echo SEVEN_TECH_URL . "Admin/includes/js/PasswordManagement.js"; ?> defer></script>

<div class="password-management" id="password_management">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="options" id="options">
        <button id="find_user">
            <h3>Find User</h3>
        </button>

        <button id="update_user">
            <h3>Update User</h3>
        </button>
    </div>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-status-bar.php'; ?>

    <form method="post" class="find-account" id="find_account">
        <h2>Find Account</h2>
        <div class="find-account-submit">
            <input type="email" name="email" placeholder="Email" id="email" required>
            <button type="submit">Find</button>
        </div>
    </form>

    <form method="post" class="recover-email" id="recover_email">
        <h3>Credentials Current</h3>
        <h4 id="credentials"></h4>
        <button type="submit" class="recover-btn" id="recover_btn">Send Recovery Email</button>
    </form>
</div>