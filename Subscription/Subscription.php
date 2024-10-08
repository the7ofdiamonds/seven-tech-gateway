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
            (new Account($email))->activate($userActivationKey);

            $unexpireAccount = (new Details($email))->unexpireAccount();

            if (!$unexpireAccount) {
                throw new Exception('Account could not be unexpired at this time.', 500);
            }
            // send subscription email
            return 'Subscribed successfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unsubscribe(String $email) {
        try {
            $expireAccount = (new Details($email))->expireAccount();

            if (!$expireAccount) {
                throw new Exception('Account could not be unexpired at this time.', 500);
            }
            // send subscription email
            return 'Unsubscribed successfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}