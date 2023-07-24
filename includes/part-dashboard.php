<section class="dashboard">
    <?php
    if (is_active_sidebar('thfw_dashboard')) {
        dynamic_sidebar('thfw_dashboard');
    } else {
        return;
    }
    ?>
</section>