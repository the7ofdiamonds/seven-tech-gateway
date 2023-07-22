<?php
$user_login = $_POST['log'];
$user_pass = $_POST['pwd'];
$user_remember = $_POST['rememberme'];

$credentials = array();
$credentials['log'] = $user_login;
$credentials['pwd'] = $user_pass;
$credentials['rememberme'] = $user_remember;
?>

<form class='signup-card card' id='signup_card' name="registerform" id="registerform" action="<?php echo esc_url( site_url( 'wp-login.php?action=register', 'login_post' ) ); ?>" method="POST">

    <label for="user_email"><?php _e( 'Email' ); ?></label>
    <input type="email" name="user_email" id="user_email" class="input" value="<?php echo esc_attr( wp_unslash( $user_email ) ); ?>" size="25" autocomplete="email" />
    
    <label for="user_login"><?php _e( 'Username' ); ?></label>
    <input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr( wp_unslash( $user_login ) ); ?>" size="20" autocapitalize="off" autocomplete="username" />

    <button id="signup-button" name='submit' type='submit'>
        <h3>SIGN UP</h3>
    </button>
</form>