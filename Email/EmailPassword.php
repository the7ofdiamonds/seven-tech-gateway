<?php

namespace SEVEN_TECH\Gateway\Email;

use Exception;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

class EmailPassword
{
    private $email;

    public function __construct()
    {
        $this->email = new Email;
    }

    function recover(Account $account, string $url)
    {
        try {
            $subject = "Password Recovery Instructions for {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailPasswordRecovery.php';

            $message = "Follow the link below to recover your password.";
            
            $button_name = 'RECOVER';

            $content = array(
                "{NAME}" => "{$account->firstName} {$account->lastName}",
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name,
                "{SUPPORT_EMAIL}" => $this->email->support_email,
                "{COMPANY_NAME}" => $this->email->company_name,
            );

            $emailSent = $this->email->sendEmail($account, $subject, $template, $content, $message);

            if (!$emailSent) {
                throw new Exception("There was an error sending password recovery email.");
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function changed(Account $account)
    {
        try {
            $subject = "Password Changed at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your password has been changed.";

            $button_name = 'LOGIN';

            $content = array(
                "{NAME}" => "{$account->firstName} {$account->lastName}",
                "{MESSAGE}" => $message,
                "{URL}" => home_url() . "/login",
                "{BUTTON_NAME}" => $button_name,
                "{SUPPORT_EMAIL}" => $this->email->support_email,
                "{COMPANY_NAME}" => $this->email->company_name,
            );

            $emailSent = $this->email->sendEmail($account, $subject, $template, $content, $message);

            if (!$emailSent) {
                throw new Exception("There was an error sending password recovery email.");
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function update(Account $account, string $url)
    {
        try {
            $subject = "Your password needs to be updated at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Below is a link to update your password.";
            
            $button_name = 'UPDATE';

            $content = array(
                "{NAME}" => "{$account->firstName} {$account->lastName}",
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name,
                "{SUPPORT_EMAIL}" => $this->email->support_email,
                "{COMPANY_NAME}" => $this->email->company_name,
            );

            $emailSent = $this->email->sendEmail($account, $subject, $template, $content, $message);

            if (!$emailSent) {
                throw new Exception("There was an error sending password recovery email.");
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
