<?php
namespace SEVEN_TECH\Gateway\Subscription;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class Subscription {

    function subscribe(String $email, String $userActivationKey)
    {
        try {
            $account = new Account($email);
            $account->activate($userActivationKey);

            $unexpireAccount = (new Details($email))->unexpireAccount($account->id);

            if (!$unexpireAccount) {
                throw new Exception('Account could not be unexpired at this time.', 500);
            }

            // send subscription email

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unsubscribe(String $email) {
        try {
            $account = new Account($email);
            $expireAccount = (new Details($email))->expireAccount($account->id);

            if (!$expireAccount) {
                throw new Exception('Account could not be unexpired at this time.', 500);
            }

            // send subscription email

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}