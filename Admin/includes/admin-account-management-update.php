<script src=<?php echo SEVEN_TECH_URL . "Admin/includes/js/AccountManagementUpdate.js"; ?> defer></script>

<form method="post" class="subscription-email" id="subscription_email">
    <h3>Subscription Current</h3>
    <h4 id="expired"></h4>
    <button type="submit" class="subscription-btn" id="subscription_btn">Send Subscription Email</button>
</form>

<form method="post" class="recover-email" id="recover_email">
    <h3>Credentials Current</h3>
    <h4 id="credentials"></h4>
    <button type="submit" class="recover-btn" id="recover_btn">Send Recovery Email</button>
</form>

<form method="post" class="lock-account" id="lock_account">
    <h3>Account Unlocked</h3>
    <h4 id="locked"></h4>
    <button type="submit" class="lock-btn" id="lock_btn">Lock</button>
    <button type="submit" class="unlock-btn" id="unlock_btn">unlock</button>
</form>

<form method="post" class="enable-account" id="enable_account">
    <h3>Account Enabled</h3>
    <h4 id="enabled"></h4>
    <button type="submit" class="enable-btn" id="enable_btn">enable</button>
    <button type="submit" class="disable-btn" id="disable_btn">disable</button>
</form>