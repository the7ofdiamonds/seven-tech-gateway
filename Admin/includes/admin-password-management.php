<script src=<?php echo SEVEN_TECH_URL . "Admin/includes/js/PasswordManagement.js"; ?> defer></script>

<div class="password-management" id="password_management">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-status-bar.php'; ?>

    <form method="post" class="recover-email" id="recover_email">
        <input type="email" name="email" placeholder="Email" id="email" required>
        <button type="submit" class="recover-btn" id="recover_btn">Send Recovery Email</button>
    </form>
</div>