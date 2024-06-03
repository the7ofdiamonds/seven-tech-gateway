<?php

namespace SEVEN_TECH\Gateway\Email;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

class EmailPassword extends Email
{
    private $exists;

    public function __construct()
    {
        $this->exists = new DatabaseExists;
    }

    function recoverPassword($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Password Recovery Instructions for {$this->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailPasswordRecovery.php';

            $auth = new Authentication($email);

            $auth->updateConfirmationCode();

            $password_reset_link = home_url() . "/{$account->email}/{$auth->confirmation_code}";

            $content = array(
                "{NAME}" => "{$account->first_name} {$account->last_name}",
                "{PASSWORD_RESET_LINK}" => $password_reset_link,
                "{SUPPORT_EMAIL}" => $this->support_email,
                "{COMPANY_NAME}" => $this->company_name,
            );

            $message = "An email has been sent to {$email} check your inbox for directions on how to reset your password. Confirmation Code: {$auth->confirmation_code}";

            $this->sendEmail($account, $subject, $template, $content, $message);

            return "An email has been sent to {$email} check your inbox for directions on how to reset your password.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function passwordChanged($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Password Changed at {$this->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your password has been changed.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->sendEmail($account, $subject, $template, $content, $message);

            return "Your password has been changed an email has been sent to {$email} check your inbox to confirm this action was completed.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
