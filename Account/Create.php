<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\User\Add;

use SEVEN_TECH\Communications\Email\Gateway\Account;
use SEVEN_TECH\Communications\Exception\DestructuredException as CommunicationsException;

use WP_Error;
use WP_User;

use Exception;

class Create
{

    function account(string $email, string $username, string $password, string $confirmPassword, string $nicename, string $nickname, string $firstname, string $lastname, string $phone): bool
    {
        try {
            $createdUser = (new Add())->user(
                $email,
                $username,
                $password,
                $confirmPassword,
                $nicename,
                $phone
            );

            $authentication = new Authentication($email);
            $authentication->addProviderGivenID($createdUser->providergivenID);
            $userActivationKey = $authentication->addActivationKey();

            $userData = new WP_User($createdUser->id);
            $userData->first_name = $firstname;
            $userData->last_name = $lastname;
            $userData->user_nicename = $nicename;
            $userData->nickname = $nickname;
            $userData->user_activation_key = $userActivationKey;
            $updatedUser = wp_insert_user($userData);

            add_user_meta($updatedUser, 'phone_number', $phone);

            $id = $userData->ID;

            (new Details($email))->addDetails($id, 'is_enabled', 1);
            (new Details($email))->addDetails($id, 'is_authenticated', 1);
            (new Details($email))->addDetails($id, 'is_account_non_expired', 0);
            (new Details($email))->addDetails($id, 'is_account_non_locked', 1);
            (new Details($email))->addDetails($id, 'is_credentials_non_expired', 1);

            if (class_exists(Account::class, true)) {
                $emailSent = (new Account())->sendSignUpEmail($id);

                if (!$emailSent) {
                    throw new Exception("Unable to send email.");
                }
            }

            return true;
        } catch (CommunicationsException $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (WP_Error $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
