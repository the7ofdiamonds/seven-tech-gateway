<div class="member-card card">

    <div class="member-photo photo-link">

        <a href="<?php echo $member->user_url ?>">
            <img src="<?php echo get_avatar_url( $member->ID, array( 'size' => 96 ) ); ?>" alt="">
        </a>
    </div>
    
    <h4 class="member-name">
        <?php echo esc_html( $member->user_firstname ." ". $member->user_lastname ); ?>
    </h4>

    <h3 class="member-title">

        <?php echo strtoupper($member->roles[0]); ?>
    </h3>
</div>