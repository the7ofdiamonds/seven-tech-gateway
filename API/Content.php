<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Content
{
    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/content/v1', '/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_content'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/headquarters/v1', '/', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_headquarters'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    function get_content(WP_REST_Request $request)
    {
        try {
            $page_slug = $request->get_param('slug');
            $page = get_page_by_path($page_slug);

            if (!$page) {
                throw new Exception('Page not found', 404);
            }

            $page_id = $page->ID;
            $page = get_post($page_id);

            if (!$page) {
                throw new Exception('Page content not found', 404);
            }

            $page_content = $page->post_content;

            // Create a DOMDocument to parse the content with UTF-8 encoding
            $doc = new \DOMDocument('1.0', 'UTF-8');
            $doc->loadHTML($page_content);

            // Use DOMXPath to query for paragraphs
            $xpath = new \DOMXPath($doc);
            $paragraphs = $xpath->query('//p');

            $paragraphArray = [];

            // Function to normalize text and remove non-breaking spaces and unwanted characters
            function normalizeText($text)
            {
                // Replace non-breaking spaces with regular spaces
                $text = str_replace("\xc2\xa0", ' ', $text);
                // Remove other unwanted characters or non-printable characters
                $text = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $text);
                return $text;
            }

            // Loop through the paragraphs and add their HTML content to the array
            foreach ($paragraphs as $paragraph) {
                // Extract the HTML content of the paragraph, normalize it, and remove unwanted characters
                $htmlContent = $doc->saveHTML($paragraph);
                $normalizedContent = normalizeText($htmlContent);
                $paragraphArray[] = $normalizedContent;
            }

            // Set the character encoding in the Content-Type header
            header('Content-Type: text/html; charset=UTF-8');

            return rest_ensure_response($paragraphArray);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code,
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }

    function get_headquarters()
    {
        try {
            $headquarters = get_option('orb-headquarters');
            
            return rest_ensure_response($headquarters);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code,
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }
}
