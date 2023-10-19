<?php

namespace SEVEN_TECH\API;

use Exception;

use SEVEN_TECH\Post_Types\Founders\Founders as PTFounders;

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

        $this->pt_founder = new PTFounders;
    }

    function get_founders()
    {
        try {
            $founder = $this->pt_founder->getFounder();

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
}
