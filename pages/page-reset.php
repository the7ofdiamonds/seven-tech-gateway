<?php get_header(); ?>

    <main class="reset">
        <div class="signInOptions">
            <a href="/sign-up">

                <button class="registerBtn" id="registerBtnSwitch">
                    <h3>SIGNUP</h3>
                </button>
            </a>

            <a href="/login">
                <button class="loginBtn" id="loginBtnSwitch">
                    <h3>LOGIN</h3>
                </button>
            </a>
        </div>
        <?php include WP_PLUGIN_DIR . '/thfw-users/includes/part-reset.php'; ?>
    </main>
<?php get_footer(); ?>