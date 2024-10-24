<?php

namespace SEVEN_TECH\Gateway\Authorization;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;

use WP_REST_Request;

use DateTime;
use DateInterval;

class Authorization
{

    public function isAuthorized(WP_REST_Request $request, $resourceLevel = '', $resourceRoles = null)
    {
        try {
            $accessToken = (new Token)->getAccessToken($request);
            $refreshToken = (new Token)->getRefreshToken($request);

            $auth = new Authenticated($accessToken, $refreshToken);
            $expiration = $auth->auth_time + 300;
            $time = time();

            error_log("Expiration: {$this->getDate($expiration)}");
            error_log("Current Time: {$this->getDate($time)}");

            if ($expiration < $time) {
                error_log("Need new token.");
                return false;
            }

            $accountRoles = $auth->roles;

            if ($auth->isAccountNonExpired == false) {
                $auth->level = 0;
            }

            if ($resourceLevel !== '' && $auth->level < $resourceLevel) {
                error_log("Need another resource level.");
                return false;
            }

            // if (is_array($accountRoles) && is_array($resourceRoles)) {
            //     foreach ($accountRoles as $accountRole) {
            //         foreach ($resourceRoles as $resourceRole) {
            //             if ($accountRole == $resourceRole) {
            //                 return true;
            //             }
            //         }
            //     }
            // }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function getDate(int $seconds) : string
    {
        $date = new DateTime("@0");
        $date->add(new DateInterval("PT{$seconds}S"));

        return $date->format('Y-m-d H:i:s');
    }
}
