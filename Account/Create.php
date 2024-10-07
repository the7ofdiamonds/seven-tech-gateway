<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Authentication\Login;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailAccount;
use SEVEN_TECH\Gateway\User\Add;

use Exception;

use WP_User;

class Create
{
    private $add;
    private $email;
    private $login;

    public function __construct()
    {
        $this->add = new Add();
        $this->email = new EmailAccount;
        $this->login = new Login;
    }

    function account($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone)
    {
        try {
            $createdUser = $this->add->user(
                $email,
                $username,
                $password,
                $nicename,
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
            $id = $account->id;
            
            $details = new Details();
            $details->add($id, 'is_enabled', 1);
            $details->add($id, 'is_authenticated', 1);
            $details->add($id, 'is_account_non_expired', 0);
            $details->add($id, 'is_account_non_locked', 1);
            $details->add($id, 'is_credentials_non_expired', 1);
            
            // $this->email->accountCreated($email);

            $auth = $this->login->signInWithEmailAndPassword($email, $password);
  
            $signupResponse = array(
                'successMessage' => 'You have been signed up successfully.',
                'id' => $account->id,
                'userActivationCode' => $account->userActivationKey,
                'confirmationCode' => $account->confirmationCode,
                'refreshToken' => $auth->refresh_token,
                'accessToken' => $auth->access_token,
                'statusCode' => 200,
            );

            return $signupResponse;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
