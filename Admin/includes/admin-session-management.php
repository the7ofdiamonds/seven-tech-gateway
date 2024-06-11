<link rel="stylesheet" href=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/css/SessionManagement.css"; ?>>
<script src=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/js/SessionManagement.js"; ?> defer></script>

<div class="session-management" id="session_management">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="options" id="options">
        <button id="get_sessions">
            <h3>Get</h3>
        </button>

        <button id="find_session">
            <h3>Find</h3>
        </button>

        <button id="configure_sessions">
            <h3>Configure</h3>
        </button>
    </div>

    <?php include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-status-bar.php'; ?>

    <?php include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-session-management-get.php'; ?>

    <?php include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-session-management-find.php'; ?>

    <?php include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-session-management-configure.php'; ?>
</div>