<link rel="stylesheet" href=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/css/SessionManagement.css"; ?>>
<script src=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/js/SessionManagement.js"; ?> defer></script>

<div class="session-management" id="session_management">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="options" id="options">
        <button id="find_user">
            <h3>Find Session</h3>
        </button>
    </div>

    <?php include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-status-bar.php'; ?>

    <form method="post" class="find-session" id="find_session">
        <h2>Find Session</h2>
        <div class="find-session-submit">
            <input type="email" name="email" placeholder="Email" id="email" required>
            <button id="find_session_btn" type="submit">Find</button>
        </div>
    </form>
    
    <div class="account-details">
        <div class="account-id">
            <h3>Account ID</h3>
            <h4 id="account_id"></h4>
        </div>

        <div class="provider-given-id">
            <h3>Provider Given ID</h3>
            <h4 id="provider_given_id"></h4>
        </div>
        
        <div class="account-status">
            <h3>Account Status</h3>
            <h4 id="account_status"></h4>
        </div>
    </div>

    <div class="sessions" id="sessions"></div>

    <?php include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-session-management-length.php'; ?>
</div>