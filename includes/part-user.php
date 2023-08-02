<?php
$current_user = wp_get_current_user();
?>
<div class="member-card">

    <div class="member-photo">
        <img src="<?php echo get_avatar_url(get_current_user_id(), array('size' => 96)); ?>" alt="">
    </div>

    <h3 class="member-name">
        <?php echo esc_html($current_user->user_firstname . " " . $current_user->user_lastname); ?>
    </h3>
</div>