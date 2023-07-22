<section class="modal" id="modal">
 <?php if(is_user_logged_in()): ?>
        <?php include 'part-dashboard.php'; ?>
<?php else: ?>
    <div class="authentication">

        <span class="auth-options" id="auth_options">

            <button class="signup-btn" id="signup_btn">

                <h3>SIGN UP</h3>
            </button>

            <button class="login-btn" id="login_btn">

                <h3>LOGIN</h3>
            </button>

            <button class="reset-btn" id="reset_btn">

                <h3>RESET</h3>
            </button>
        </span>

        <?php include 'part-login.php'; ?>
        <?php include 'part-reset.php'; ?>
        <?php include 'part-signup.php'; ?>
    </div>
<?php endif; ?>
    <button class="modal-close" id="modal_close">

        <h2>X</h2>
    </button>
</section>
