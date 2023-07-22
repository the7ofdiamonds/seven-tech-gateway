<div class="team">

    <?php
    $args = array('post_type'=>array('posts', 'team'));
    
    $team = get_users(array( 
      'role__in' => array( 
        'author',
        'shop manager',
        'editor',
        'founder/managing member',
    )));

    if ( $team ):

        foreach($team as $member): ?>
    
    <?php include WP_PLUGIN_DIR . '/thfw-users/includes/part-member.php';?>

  <?php endforeach; endif; ?>

</div>