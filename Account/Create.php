<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Authentication\Login;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailAccount;
use SEVEN_TECH\Gateway\User\Add;

use Exception;
use WP_Error;
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

    function account(string $email, string $username, string $password, string $confirmPassword, string $nicename, string $nickname, string $firstname, string $lastname, string $phone)
    {
        try {
            $createdUser = $this->add->user(
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
            $confirmationCode = $authentication->addConfirmationCode();

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
            
            $this->email->accountCreated($email);

            $auth = $this->login->withEmailAndPassword($email, $password);
  
            $signupResponse = array(
                'successMessage' => 'You have been signed up successfully.',
                'id' => $id,
                'userActivationCode' => $userActivationKey,
                'confirmationCode' => $confirmationCode,
                'refreshToken' => $auth->refresh_token,
                'accessToken' => $auth->access_token,
                'statusCode' => 200,
            );

            return $signupResponse;
        } catch (WP_Error $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
