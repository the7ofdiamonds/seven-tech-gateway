<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Logout
{

    public function logout(WP_REST_Request $request)
    {
        try {
            $display_name = $request['username'];

            if (empty($display_name)) {
                $logoutResponse = [
                    'message_type' => 'error',
                    'message' => 'A Username is required for login'
                ];

                $response = rest_ensure_response($logoutResponse);
                $response->set_status(200);

                return $response;
            }

            global $wpdb;

            $storedProcedureName = 'findUserByUsername';

            $results = $wpdb->get_results($wpdb->prepare("CALL $storedProcedureName(%s)", $display_name));

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
            }

            if ($results == null) {
                $logoutResponse = [
                    'message_type' => 'error',
                    'message' => 'User could not be found with the username ' . $display_name . '.'
                ];

                $response = rest_ensure_response($logoutResponse);
                $response->set_status(200);

                return $response;
            }

            $userData = $results[0];
            wp_set_current_user($userData->id);
            
            wp_logout();

            if (is_user_logged_in()) {
                $response = rest_ensure_response('User could not be logged out.');
                $response->set_status(400);

                return $response;
            }

            $logoutResponse = [
                'message_type' => 'success',
                'message' => 'You have been logged out',
                'username' => $display_name
            ];

            $response = rest_ensure_response($logoutResponse);
            $response->set_status(200);

            return $response;
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
