<?php

namespace SEVEN_TECH\Gateway\Email;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

class EmailUser
{
    private $exists;
    private $email;

    public function __construct()
    {
        $this->exists = new DatabaseExists;
        $this->email = new Email;
    }

    function userAdded($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your account has been locked at {$this->email->site_name}";
// New user email template
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

    function usernameChanged($email, $username)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your username has been changed at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your username has been changed to {$username}.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return $message;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function namechanged($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your name has been changed at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your name has been changed to {$account->firstName} {$account->lastName}.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return $message;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function nicknameChanged($email, $nickname)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your nickname has been changed at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your nickname has been changed to {$nickname}.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return $message;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function nicenameChanged($email, $nicename)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your nicename has been changed at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your nicename has been changed to {$nicename}.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return $message;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function phoneChanged($email, $phone)
    {
        try {
            $this->exists->existsByEmail($email);

            $account = new Account($email);

            $subject = "Your phone number has been changed at {$this->email->site_name}";

            $template = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailBody.php';

            $message = "Your phone number has been changed to {$phone}.";
            $url = home_url() . "/login";
            $button_name = 'LOGIN';

            $content = array(
                "{MESSAGE}" => $message,
                "{URL}" => $url,
                "{BUTTON_NAME}" => $button_name
            );

            $this->email->sendEmail($account, $subject, $template, $content, $message);

            return $message;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
