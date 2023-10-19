<h2>ABOUT</h2>

<div class="mission-statement-card card">
    <h4 class="mission-statement">
        <q>
            <?php echo get_option('mission-statement'); ?>
        </q>
    </h4>
</div>

<?php
$page_slug = 'about';
$page = get_page_by_path($page_slug);

if ($page) {
    $page_id = $page->ID;
    $page = get_post($page_id);

    if ($page) {
        $page_content = $page->post_content;

        echo $page_content;
    }
} ?>