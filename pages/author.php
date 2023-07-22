<?php get_header(); ?>
<?php $firstName = get_the_author_meta('user_firstname', $post->post_author);
$lastName = get_the_author_meta('user_lastname', $post->post_author);
?>

<nav class="author-nav card">
    <a href="#intro">
        <h2 class="author-name" id="top"><?php echo "$firstName $lastName" ?></h2>
    </a>

    <a href="#portfolio">
        <h2>PORTFOLIO</h2>
    </a>

    <a href="#resume">
        <h2>RÉSUMÉ</h2>
    </a>
</nav>

<section class="author-intro" id="intro">

    <div class="author-photo card">

        <img src="<?php echo get_avatar_url($post->post_author, $size = 48, $default = '', $alt = '', $args = array( 'class' => 'wt-author-img' )) ?>" alt="">
    </div>

    <div class="author-card card">

        <p class="author-greeting">My name is Jamel C. Lyons a designer programmer with knowledge and experience architecting backends. I am on a mission to make the world a better by digitizing processes. Welcome to this presentation of my life’s work.</p>
    </div>
</section>

<section class="portfolio" id="portfolio">

    <?php
    if (is_active_sidebar('thfw_author')) {
        dynamic_sidebar('thfw_author');
    } else {
        return;
    }
    ?>

</section>
<?php get_footer(); ?>