<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailAccount;
use SEVEN_TECH\Gateway\Model\Response\ResponseCreateAccount;
use SEVEN_TECH\Gateway\User\UserCreate;

use Exception;

use WP_User;

class AccountCreate
{
    private $userCreate;
    private $email;

    public function __construct()
    {
        $this->userCreate = new UserCreate();
        $this->email = new EmailAccount;
    }

    function createAccount($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone)
    {
        try {
            $createdUser = $this->userCreate->createUser(
                $email,
                $username,
                $password,
                $nicename,
                $nickname,
                $firstname,
                $lastname,
                $phone
            );

            $userData = new WP_User($createdUser->id);
            $userData->first_name = $firstname;
            $userData->last_name = $lastname;
            $userData->user_nicename = $nicename;
            $userData->nickname = $nickname;
            $userData->user_activation_key = wp_generate_password(20, false);
            wp_update_user($userData);

            $authentication = new Authentication($email);
            $authentication->addProviderGivenID($createdUser->providergivenID);
            $authentication->addConfirmationCode();

            $account = new Account($email);

            // $this->email->accountCreated($email);

            return new ResponseCreateAccount($account->id, $account->user_activation_code, $account->confirmation_code);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
