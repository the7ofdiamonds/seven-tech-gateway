<?php

namespace SEVEN_TECH\Admin;

use Exception;

class AdminUserManagement
{
    public function getUser($email)
    {
        try {
            $user = get_user_by('email', $email);
            $user_id = $user->id;
// Get all user info
            return rest_ensure_response($user_id);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'errorMessage' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }
}
