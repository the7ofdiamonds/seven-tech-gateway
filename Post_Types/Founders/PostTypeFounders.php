<?php

namespace SEVEN_TECH\Founders\Post_Types;

use Exception;

/**
 * @package SEVEN TECH
 */

class PostTypeFounders
{
    public function __construct()
    {
        add_action('init', [$this, 'add_founder_page']);
    }

    function extractNameFromString($inputString)
    {
        // Use a regular expression to remove non-alphabetic characters
        $nameOnly = preg_replace('/[^A-Za-z]/', '', $inputString);

        // Convert the result to lowercase
        $lowercaseName = strtolower($nameOnly);

        return $lowercaseName;
    }

    function add_founder_page()
    {
        try {
            // Get users with roles 'founder/managing member' or 'team'
            $users = get_users(array(
                'role__in' => array(
                    'founder',
                )
            ));

            if (!empty($users)) {
                foreach ($users as $user) {
                    $user_data = get_userdata($user->ID);
                    $first_name = $user_data->first_name;
                    $last_name = $user_data->last_name;

                    // Extract a cleaned and lowercase name
                    $post_title = $first_name . ' ' . $last_name;
                    $post_slug = strtolower(preg_replace('/[^a-zA-Z]/', '', $post_title)); // Remove non-letter characters

                    // Check if a post with this slug already exists
                    $existing_post = get_page_by_path($post_slug, OBJECT, 'founders');

                    if (is_null($existing_post)) {
                        // Create a new team member page
                        $args = array(
                            'post_title'    => $post_title,
                            'post_content'  => '',
                            'post_status'   => 'publish',
                            'post_type'     => 'founders',
                            'post_name'     => $post_slug, // Set the post name to the slug
                        );

                        $team_member_page = wp_insert_post($args);

                        if (!is_wp_error($team_member_page)) {
                            // Success
                        } else {
                            throw new Exception("Failed to create team member page: " . $team_member_page->get_error_message(), $team_member_page->get_error_code());
                        }
                    } else {
                        // A post with the same slug already exists, skip creation.
                    }
                }
            } else {
                throw new Exception("No Founders found.", 404);
            }
        } catch (Exception $e) {
            error_log(("Error: " . $e->getMessage())); // Log the error message
            throw new Exception("An error occurred while creating team member pages. Please try again later."); // Display a user-friendly error message
        }
    }

    function add_post_meta_boxes()
    {
        add_meta_box(
            "post_metadata_member_name", // div id containing rendered fields
            "Founder Name", // section heading displayed as text
            [$this, 'post_meta_box_member_name'], // callback function to render fields
            "team", // name of post type on which to render fields
            "side", // location on the screen
            "low" // placement priority
        );

        add_meta_box(
            "post_metadata_member_title", // div id containing rendered fields
            "Founder Title", // section heading displayed as text
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

        echo "<input type=\"text\" name=\"member_name\" value=\"" . $field . "\" placeholder=\"Founder Name\">";
    }

    function post_meta_box_member_title()
    {
        global $post;
        $custom = get_post_custom($post->ID);
        $field = $custom["member_title"][0];

        echo "<input type=\"text\" name=\"member_title\" value=\"" . $field . "\" placeholder=\"Founder Title\">";
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
