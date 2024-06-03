<?php

namespace SEVEN_TECH\Gateway\Email;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

class EmailAccount
{
    private $exists;
    private $email;

    public function __construct()
    {
        $this->exists = new DatabaseExists;
        $this->email = new Email;
    }

    function accountCreated($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your new account at {$this->email->site_name}";
// Create a welcome email template
            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your password has been changed.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return "Your password has been changed an email has been sent to {$email} check your inbox to confirm this action was completed.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function accountLocked($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your account has been locked at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your account has been locked.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return "Your account has been locked.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function accountUnlocked($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your account has been unlocked at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your account has been unlocked.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return "Your password has been changed an email has been sent to {$email} check your inbox to confirm this action was completed.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function accountDisabled($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your account has been disabled at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your account has been disabled.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return "Your account has been disabled.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function accountEnabled($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your account has been enabled at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your password has been changed.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return "Your account has been enabled.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function accountDeleted($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your account at {$this->email->site_name} has been deleted.";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your password has been changed.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return "This account has been deleted.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
