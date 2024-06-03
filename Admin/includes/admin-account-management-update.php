<script src=<?php echo SEVEN_TECH_GATEWAY_URL . "Admin/includes/js/AccountManagementUpdate.js"; ?> defer></script>

<form method="post" class="subscription" id="subscription">
    <h3>Subscription Current</h3>
    <h4 id="expired"></h4>
    <button type="submit" class="subscribe-btn" id="subscribe_btn">Subscribe</button>
    <button type="submit" class="unsubscribe-btn" id="unsubscribe_btn">Unsubscribe</button>
</form>

<form method="post" class="password" id="password">
    <h3>Credentials Current</h3>
    <h4 id="credentials"></h4>
    <button type="submit" class="expire-btn" id="expire_btn">Expire</button>
    <button type="submit" class="unexpire-btn" id="unexpire_btn">Unexpire</button>
</form>

<form method="post" class="lock-account" id="lock_account">
    <h3>Account Unlocked</h3>
    <h4 id="locked"></h4>
    <button type="submit" class="lock-btn" id="lock_btn">Lock</button>
    <button type="submit" class="unlock-btn" id="unlock_btn">Unlock</button>
</form>

<form method="post" class="enable-account" id="enable_account">
    <h3>Account Enabled</h3>
    <h4 id="enabled"></h4>
    <button type="submit" class="enable-btn" id="enable_btn">Enable</button>
    <button type="submit" class="disable-btn" id="disable_btn">Disable</button>
</form>