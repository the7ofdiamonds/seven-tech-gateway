<?php

namespace SEVEN_TECH\API;

use Exception;
use SEVEN_TECH\Post_Types\Team\Team as PTTeam;

class Team
{
    private $pt_team;

    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/users/v1', '/team', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_team'),
                'permission_callback' => '__return_true',
            ));
        });

        $this->pt_team = new PTTeam;
    }

    function get_team()
    {
        try {
            $team = $this->pt_team->getTeam();

            return rest_ensure_response($team);
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
