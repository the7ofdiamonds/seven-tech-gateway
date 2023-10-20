<?php

namespace SEVEN_TECH\API;

use Exception;

use SEVEN_TECH\Post_Types\Founders\Founders as PTFounders;

use WP_REST_Request;

class Founders
{
    private $pt_founder;

    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/users/v1', '/founders', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_founders'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/users/v1', '/founder/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_founder'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/users/v1', '/founder/(?P<slug>[a-zA-Z0-9-_]+)/resume', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_founder_resume'),
                'permission_callback' => '__return_true',
            ));
        });

        $this->pt_founder = new PTFounders;
    }

    function get_founders()
    {
        try {
            $founders = $this->pt_founder->getFounders();

            return rest_ensure_response($founders);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }

    function get_founder(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');

            $founder = $this->pt_founder->getFounder($slug);

            return rest_ensure_response($founder);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }

    function get_founder_resume(WP_REST_Request $request)
    {
        try {
            $pageTitle = $request->get_param('slug');

            $resume_pdf_url = $this->pt_founder->getFounderResume($pageTitle);

            return rest_ensure_response($resume_pdf_url);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }
}
