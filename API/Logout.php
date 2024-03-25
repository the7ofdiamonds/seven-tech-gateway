<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Logout
{

    public function logout(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            if (empty($email)) {
                $logoutResponse = [
                    'errorMessage' => 'A Email is required to logout'
                ];

                $response = rest_ensure_response($logoutResponse);
                $response->set_status(400);

                return $response;
            }

            global $wpdb;

            $storedProcedureName = 'findUserByEmail';

            $results = $wpdb->get_results($wpdb->prepare("CALL $storedProcedureName(%s)", $email));

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if ($results == null) {
                $loginResponse = [
                    'errorMessage' => 'This email could not be found'
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status(404);

                return $response;
            }

            $userData = $results[0];
            wp_set_current_user($userData->id);

            wp_logout();

            if (is_user_logged_in()) {
                $logoutResponse = [
                    'errorMessage' => 'User could not be logged out.'
                ];

                $response = rest_ensure_response($logoutResponse);
                $response->set_status(400);

                return $response;
            }

            $logoutResponse = [
                'successMessage' => 'You have been logged out'
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
