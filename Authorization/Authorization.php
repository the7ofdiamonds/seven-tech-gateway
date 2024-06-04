<?php

namespace SEVEN_TECH\Gateway\Authorization;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;

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
            $accessToken = $this->token->getAccessToken($request);
            $email = $this->token->getEmailFromToken($accessToken);
            $account = new Account($email);
            $accountRoles = $account->roles;

            if ($account->email == $request['email']) {
                return $account;
            }

            if ($account->is_account_non_expired == 0) {
                $account->level = 0;
            }

            if ($account->level == $resourceLevel) {
                return $account;
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
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
