<h1>Administration Options</h1>

<?php settings_errors(); ?>
<form method="post" action="options.php">
    <?php settings_fields( 'thfw-admin-about-group' ); ?>
    <?php do_settings_sections( 'thfw_about' ); ?>
    <?php submit_button(); ?>
</form>