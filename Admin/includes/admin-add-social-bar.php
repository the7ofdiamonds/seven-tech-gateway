<h1>Administration Options</h1>

<?php settings_errors(); ?>
<form method="post" action="options.php">
    <?php settings_fields( 'seven-tech-admin-contact-group' ); ?>
    <?php do_settings_sections( 'seven_tech_contact' ); ?>
    <?php submit_button(); ?>
</form>