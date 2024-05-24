<?php

namespace SEVEN_TECH\Gateway\Authorization;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;

use WP_REST_Request;

class Authorization
{
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function isAuthorized(WP_REST_Request $request, $resourceLevel = '', $resourceRoles = '')
    {
        try {
            $authenticatedAccount = $this->token->signInWithRefreshToken($request);
            $accountRoles = $authenticatedAccount->roles;

            if ($authenticatedAccount->email == $request['email']) {
                return $authenticatedAccount;
            }

            if ($authenticatedAccount->level == $resourceLevel) {
                return $authenticatedAccount;
            }

            if (is_array($accountRoles) && is_array($resourceRoles)) {
                foreach ($accountRoles as $accountRole) {
                    foreach ($resourceRoles as $resourceRole) {
                        if ($accountRole == $resourceRole) {
                            return true;
                        }
                    }
                }
            }

            return false;
        } catch (Exception | DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
