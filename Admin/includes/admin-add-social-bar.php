<h1>Administration Options</h1>

<?php settings_errors(); ?>
<form method="post" action="options.php">
    <?php settings_fields( 'thfw-admin-contact-group' ); ?>
    <?php do_settings_sections( 'thfw_contact' ); ?>
    <?php submit_button(); ?>
</form>