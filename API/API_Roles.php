<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Roles\Roles;

use Exception;

use WP_REST_Request;

class API_Roles
{
    private $roles;
    private $authorization;

    public function __construct(Roles $roles, Authorization $authorization)
    {
        $this->roles = $roles;
        $this->authorization = $authorization;
    }

    public function getRoles(WP_REST_Request $request)
    {
        try {
            $roles = $this->roles->getRoles();

            return rest_ensure_response($roles);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    public function getAvailableRoles(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            $availableRoles = $this->roles->getAvailableRoles($authorized->level);

            return rest_ensure_response($availableRoles);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
