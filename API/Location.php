<?php

namespace SEVEN_TECH\API;

use Exception;

class Location
{
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
