<section class="seven-tech-admin">
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php settings_fields('seven-tech-admin-group'); ?>
        <?php do_settings_sections('seven-tech'); ?>
        <?php submit_button(); ?>
    </form>
</section>