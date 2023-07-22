<?php
    $current_user = wp_get_current_user();
?>
<div class="card member-card">

    <h3 class="member-title">
        <?php echo ucfirst( $current_user->roles[0] ); ?>
    </h3>
    <div class="member-photo">
        <img src="<?php echo get_avatar_url( get_current_user_id(), array( 'size' => 96 ) ); ?>" alt="">
    </div>
    <h4 class="member-name">
    <?php echo esc_html( $current_user->user_firstname ." ". $current_user->user_lastname ); ?>
    </h4>

    <h4 class="member-login">
    <?php echo esc_html( $current_user->display_name ); ?>
    </h4>
</div>    