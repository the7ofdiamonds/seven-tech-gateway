<div class="account-management" id="account_management">
    <h1>Account Management</h1>

    <form method="post" class="find-account" id="find_account">
        <h3>Find Account</h3>
        <div class="find-account-submit">
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Find</button>
        </div>
    </form>

    <div class="account" id="account">
        <div class="ids" id="ids">
            <div class="account-id">
                <h3>Account ID</h3>
                <h4 id="account_id"></h4>
            </div>

            <div class="provider-given-id">
                <h3>Provider Given ID</h3>
                <h4 id="provider_given_id"></h4>
            </div>
        </div>

        <div class="contact" id="contact">
            <div class="email">
                <h3>Email</h3>
                <h4 id="email"></h4>
            </div>

            <div class="phone">
                <h3>Phone</h3>
                <h4 id="phone"></h4>
            </div>
        </div>

        <div class="names">
            <div class="username">
                <h3>Username</h3>
                <h4 id="username"></h4>
            </div>

            <div class="nicename">
                <h3>Nicename</h3>
                <h4 id="nicename"></h4>
            </div>

            <div class="full-name">
                <h3>Full Name</h3>
                <h4 id="full_name"></h4>
            </div>
        </div>

        <div class="account-status">
            <div class="account-status-label">
                <h3>Account Status</h3>
                <h4 id="authenticated"></h4>
            </div>

            <div class="sessions" id="sessions"></div>
        </div>

        <div class="roles" id="roles">
            <h3>Roles</h3>
            <div class="roles-row" id="roles_row"></div>
        </div>
    </div>

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

    <form method="post" class="delete-account" id="delete_account">
        <h3>Delete Account</h3>
        <button type="submit" class="delete-btn" id="delete_btn">Delete</button>
    </form>
</div>