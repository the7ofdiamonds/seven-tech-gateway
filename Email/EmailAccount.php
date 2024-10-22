<?php

namespace SEVEN_TECH\Gateway\Email;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use SEVEN_TECH\Communications\Email\Gateway\EmailGateway;

class EmailAccount
{
    private $email;

    public function __construct()
    {
        $this->email = new Email;

        if (class_exists(EmailGateway::class, true)) {
            $this->email = new EmailGateway();
        }
    }

    function accountCreated($user_id)
    {
        try {
            $this->email->sendSignUpEmail($user_id);

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function accountActivate($user_id)
    {
        try {
            $this->email->sendActivateAccountEmail($user_id);

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function accountLocked($user_id)
    {
        try {
            $this->email->sendAccountLockedEmail($user_id);

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function accountUnlocked($user_id)
    {
        try {
            $this->email->sendAccountUnlockedEmail($user_id);

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function accountRecover($user_id)
    {
        try {
            $this->email->sendAccountRecoveredEmail($user_id);

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
