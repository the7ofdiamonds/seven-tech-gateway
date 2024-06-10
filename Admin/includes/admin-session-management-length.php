<link rel="stylesheet" href=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/css/SessionManagementLength.css"; ?>>
<script src=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/js/SessionManagementLength.js"; ?> defer></script>

<div class="session-management-length" id="session_management_length">
    <form method="post" class="session-length" id="session_length">
        <h3>Session Length</h3>
        <select name="session_length" id="session_length_select">
            <option value="31536000">Year</option>
            <option value="2592000">Month</option>
            <option value="604800">Week</option>
            <option value="86400">Day</option>
            <option value="43200">12 Hour</option>
            <option value="21600">6 Hour</option>
            <option value="10800">3 Hour</option>
            <option value="5400">1 Hour</option>
        </select>

        <button type="submit" class="update-btn" id="update_btn">Update</button>
    </form>
</div>