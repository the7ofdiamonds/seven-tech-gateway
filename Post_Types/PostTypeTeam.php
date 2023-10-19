<?php

namespace SEVEN_TECH\Post_Types;

/**
 * @package SEVEN TECH
 */

class PostTypeTeam
{
    public function __construct()
    {
        add_action('init', [$this, 'custom_post_type']);
        // add_action('init', [$this, 'add_team_member_page']);
        // add_action( 'add_meta_boxes', array( $this, 'add_post_meta_boxes' ) );
        // add_action( 'save_post', array( $this, 'save_post_member_name' ) );
        // add_action( 'save_post', array( $this, 'save_post_member_title' ) );
        // add_action( 'save_post', array( $this, 'save_post_hacker_rank_link' ) );
    }

    function custom_post_type()
    {
        $labels = array(
            'name' => 'Team',
            'singular_name' => 'Member',
            'add_new' => 'Add Member',
            'all_items' => 'Team',
            'add_new_item' => 'Add New Member',
            'edit_item' => 'Edit Item',
            'new_item' => 'New Item',
            'view_item' => 'View Item',
            'search_item' => 'Search Members',
            'not_found' => 'Member Not Found',
            'not_found_in_trash' => 'No members found in trash',
            'parent_item_colon' => 'Parent Item'
        );

        $args = array(
            'labels' => $labels,
            'show_ui' => true,
            'menu_icon' => 'dashicons-groups',
            'show_in_rest' => true,
            'show_in_nav_menus' => true,
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'query_var' => true,
            'rewrite' => array(
                'with_front' => false,
                'slug'       => 'team'
            ),
            'hierarchical' => true,
            'supports' => [
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'custom-fields',
                'revisions',
                'page-attributes',
            ],
            'taxonomies' => array('category', 'post_tag'),
            'menu_position' => 7,
            'exclude_from_search' => false
        );

        register_post_type('team', $args);
    }

    function extractNameFromString($inputString)
    {
        // Use a regular expression to remove non-alphabetic characters
        $nameOnly = preg_replace('/[^A-Za-z]/', '', $inputString);

        // Convert the result to lowercase
        $lowercaseName = strtolower($nameOnly);

        return $lowercaseName;
    }

    function add_team_member_page()
    {
        // Get users with roles 'founder/managing member' or 'team'
        $users = get_users(array(
            'role__in' => array(
                'founder/managing member',
                'team'
            )
        ));
    
        // Check if users were found
        if (!empty($users)) {
            foreach ($users as $user) {
                $user_data = get_userdata($user->ID);
                $first_name = $user_data->first_name;
                $last_name = $user_data->last_name;
                
                // Extract a cleaned and lowercase name
                $post_title = $first_name . ' ' . $last_name;
                $post_slug = strtolower(preg_replace('/[^a-zA-Z]/', '', $post_title)); // Remove non-letter characters
    
                // Check if a post with this slug already exists
                $existing_post = get_page_by_path($post_slug, OBJECT, 'team');
    
                if (is_null($existing_post)) {
                    // Create a new team member page
                    $args = array(
                        'post_title'    => $post_title,
                        'post_content'  => '',
                        'post_status'   => 'publish',
                        'post_type'     => 'team',
                        'post_name'     => $post_slug, // Set the post name to the slug
                    );
    
                    $team_member_page = wp_insert_post($args);
    
                    if (!is_wp_error($team_member_page)) {
                        // Success
                    } else {
                        echo "Failed to create team member page: " . $team_member_page->get_error_message();
                    }
                } else {
                    // A post with the same slug already exists, skip creation.
                }
            }
        } else {
            echo "No Team Members found.";
        }
    }
    
    function add_post_meta_boxes()
    {
        add_meta_box(
            "post_metadata_member_name", // div id containing rendered fields
            "Member Name", // section heading displayed as text
            [$this, 'post_meta_box_member_name'], // callback function to render fields
            "team", // name of post type on which to render fields
            "side", // location on the screen
            "low" // placement priority
        );

        add_meta_box(
            "post_metadata_member_title", // div id containing rendered fields
            "Member Title", // section heading displayed as text
            [$this, 'post_meta_box_member_title'], // callback function to render fields
            "team", // name of post type on which to render fields
            "normal", // location on the screen
            "low" // placement priority
        );

        add_meta_box(
            "post_metadata_hacker_rank_link", // div id containing rendered fields
            "Hacker Rank Link", // section heading displayed as text
            [$this, 'post_meta_box_hacker_rank_link'], // callback function to render fields
            "team", // name of post type on which to render fields
            "normal", // location on the screen
            "low" // placement priority
        );
    }

    function post_meta_box_member_name()
    {
        global $post;
        $custom = get_post_custom($post->ID);
        $field = $custom["member_name"][0];

        echo "<input type=\"text\" name=\"member_name\" value=\"" . $field . "\" placeholder=\"Member Name\">";
    }

    function post_meta_box_member_title()
    {
        global $post;
        $custom = get_post_custom($post->ID);
        $field = $custom["member_title"][0];

        echo "<input type=\"text\" name=\"member_title\" value=\"" . $field . "\" placeholder=\"Member Title\">";
    }

    function post_meta_box_hacker_rank_link()
    {
        global $post;
        $custom = get_post_custom($post->ID);
        $field = $custom["hacker_rank_link"][0];

        echo "<input type=\"text\" name=\"hacker_rank_link\" value=\"" . $field . "\" placeholder=\"Hacker Rank Link\">";
    }

    // save field value
    function save_post_member_name()
    {
        global $post;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // if ( get_post_status( $post->ID ) === 'auto-draft' ) {
        //     return;
        // }
        update_post_meta($post->ID, "member_name", sanitize_text_field($_POST["member_name"]));
    }

    function save_post_member_title()
    {
        global $post;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // if ( get_post_status( $post->ID ) === 'auto-draft' ) {
        //     return;
        // }
        update_post_meta($post->ID, "member_title", sanitize_text_field($_POST["member_title"]));
    }

    function save_post_hacker_rank_link()
    {
        global $post;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // if ( get_post_status( $post->ID ) === 'auto-draft' ) {
        //     return;
        // }
        update_post_meta($post->ID, "hacker_rank_link", sanitize_text_field($_POST["hacker_rank_link"]));
    }
}
