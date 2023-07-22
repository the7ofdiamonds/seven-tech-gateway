<?php get_header();?>

    <section class="member-page">

        <?php

        get_post();

        if ( have_posts() ) : while ( have_posts() ) : the_post();
        ?>

        <h3 class="member-title">
            <?php echo get_post_meta(get_the_id(), 'member_title', true); ?>
        </h3>

        <div class="member-photo card">
            
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?>
            </a>
        </div>

        <div class="member-name card">

            <h4>
                <?php echo get_post_meta(get_the_id(), 'member_name', true); ?>
            </h4>
        </div>

        <div class="member-about card">

            <?php the_content();?>
        </div>

        <div class="social-icons">

            <a href="<?php echo get_post_meta(get_the_id(), 'github_link', true); ?>" target="_blank">
                <img src="/wordpress/wp-content/uploads/2022/11/octocat.png">
            </a>

            <a href="<?php echo get_post_meta(get_the_id(), 'hacker_rank_link', true); ?>" target="_blank">
                <img src="/wordpress/wp-content/uploads/2022/11/4373234_hackerrank_logo_logos_icon.png">
            </a>

            <a href="<?php echo get_post_meta(get_the_id(), 'behance_link', true); ?>" target="_blank">
                <img src="/wordpress/wp-content/uploads/2022/11/behance.png">
            </a>
        </div>
        <?php endwhile; else: endif;?>
    </section>

<?php get_footer();?>