<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Roles\Roles;

use WP_REST_Request;

class API_Roles
{
    private $authorization;

    public function __construct()
    {
        $this->authorization = new Authorization;
    }

    public function getRoles(WP_REST_Request $request)
    {
        try {
            $roles = (new Roles)->getRoles();

            return rest_ensure_response($roles);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    // public function getAvailableRoles(WP_REST_Request $request)
    // {
    //     try {
    //         $authorized = $this->authorization->isAuthorized($request);

    //         $availableRoles = (new Roles)->getAvailableRoles($authorized->level);

    //         return rest_ensure_response($availableRoles);
    //     } catch (DestructuredException $e) {
    //         return (new DestructuredException($e))->rest_ensure_response_error();
    //     }
    // }
}
