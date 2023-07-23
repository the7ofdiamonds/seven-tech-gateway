<?php if(is_single()):
global $post; 
    $post_author = $post->post_author;
    $firstName = get_the_author_meta('user_firstname', $post_author);
    $lastName = get_the_author_meta('user_lastname', $post_author);
    $author = get_userdata($post_author);
    $authorRoles = $author->roles;
    $linkedin_link = esc_attr( get_option( 'linkedin_link' ) );
    $hackerrank_link = esc_attr( get_option( 'hackerrank_link' ) );
    $github_link = esc_attr( get_option( 'github_link' ) );
?>

<div class="author-info card">

    <div class="left">
        <a href="<?php echo get_author_posts_url($post_author); ?>">
            <img src="<?php echo get_avatar_url($post_author, $size = 48, $default = '', $alt = '', $args = array( 'class' => 'wt-author-img' )) ?>" alt="">
        </a>

        <h4><?php echo "$firstName $lastName" ?></h4>

        <p><?php echo ucfirst($authorRoles[0]); ?></p>
        <div class="author-social">

            <a href="<?php print $linkedin_link ?>" target="_blank">
                <i class="fa fa-linkedin fa-fw"></i>
            </a>

            <a href="<?php print $hackerrank_link ?>" target="_blank">
                <i class="fa-brands fa-hackerrank fa-fw"></i>
            </a>

            <a href="<?php print $github_link ?>" target="_blank">
                <i class="fa fa-github fa-fw"></i>
            </a>
        </div>

    </div>
    <div class="right">
        <h3 class="about-title">About
            <?php the_author_meta('user_firstname', $post_author); ?>
        </h3>
        <p><?php the_author_meta('description', $post_author); ?></p>

        <button onclick="window.open('mailto:<?php echo get_the_author_meta('email', $post_author); ?>')">
            <h3>Hire
                <?php the_author_meta('user_firstname', $post_author); ?>
            </h3>
        </button>
    </div>
</div>
<?php else: return; endif; ?>