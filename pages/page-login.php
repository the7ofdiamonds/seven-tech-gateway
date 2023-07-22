<?php get_header();?>

    <main class="login">

        <div class="signInOptions">

            <a href="/sign-up">
                <button class="registerBtn" id="signupBtnSwitch">
                    <h3>SIGNUP</h3>
                </button>
            </a>

            <a href="/reset">
                <button class="resetBtn" id="resetBtnSwitch">
                    <h3>RESET</h3>
                </button>
            </a>
        </div>

        <?php include WP_PLUGIN_DIR . '/thfw-users/includes/part-login.php'; ?>

    </main>

<?php get_footer();?>