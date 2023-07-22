<?php get_header();?>

    <main class="signup">
        <div class="signInOptions">

            <a href="/login">
                <button class="loginBtn" id="loginBtnSwitch">
                    <h3>LOGIN</h3>
                </button>
            </a> 

            <a href="/reset">
                <button class="resetBtn" id="resetBtnSwitch">
                    <h3>RESET</h3>
                </button>
            </a>
        </div>
        <?php include WP_PLUGIN_DIR . '/thfw-users/includes/part-signup.php'; ?>
    </main>
<?php get_footer();?>