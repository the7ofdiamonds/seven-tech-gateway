<section class="seven-tech-admin">
    <h1>Settings</h1>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php settings_fields('seven-tech-admin-group'); ?>
        <?php do_settings_sections('seven_tech_admin'); ?>
        <?php submit_button(); ?>
    </form>
</section>