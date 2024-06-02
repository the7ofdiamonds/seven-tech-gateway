<?php

namespace SEVEN_TECH\Gateway\Email;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Email
{
    private $mailer;
    private $smtp_host;
    private $smtp_port;
    private $smtp_secure;
    private $smtp_auth;
    private $smtp_username;
    private $smtp_password;
    private $from_email;
    private $from_name;
    private $body;
    private $web_address;
    private $logo_link;
    private $site_name;
    private $facebook;
    private $twitter;
    private $contact_email;
    private $linkedin;
    private $instagram;
    private $year;
    private $company_name;
    private $emailTemplateHeader;
    private $emailTemplateFooter;

    public function __construct(PHPMailer $mailer)
    {
        $this->smtp_host = get_option('quote_smtp_host');
        $this->smtp_port = get_option('quote_smtp_port');
        $this->smtp_secure = get_option('quote_smtp_secure');
        $this->smtp_auth = get_option('quote_smtp_auth');
        $this->smtp_username = get_option('quote_smtp_username');
        $this->smtp_password = get_option('quote_smtp_password');
        $this->from_email = get_option('quote_email');
        $this->from_name = get_option('quote_name');

        $this->mailer = $mailer;

        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        $this->web_address = esc_url(home_url());
        $this->logo_link = '';

        if (!empty($logo[0])) {
            $this->logo_link = esc_url($logo[0]);
        }

        $this->site_name = get_bloginfo('name');

        $this->facebook = esc_attr(get_option('facebook_link'));
        $this->twitter = esc_attr(get_option('twitter_link'));
        $this->contact_email = esc_attr(get_option('contact_email'));
        $this->linkedin = esc_attr(get_option('linkedin_link'));
        $this->instagram = esc_attr(get_option('instagram_link'));
        $this->year = date("Y");
        $this->company_name = get_theme_mod('footer_company');

        $this->emailTemplateHeader = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailHeader.php';
        $this->body = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailGatewayLink.php';
        $this->emailTemplateFooter = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailFooter.php';
    }

    public function emailHeader()
    {
        try {
            $swap_var = array(
                "{WEB_ADDRESS}" => $this->web_address,
                "{LOGO_LINK}" => $this->logo_link,
                "{SITE_NAME}" => $this->site_name,
            );

            if (!file_exists($this->emailTemplateHeader)) {
                throw new Exception('Unable to locate contact email template.');
            }

            $header = file_get_contents($this->emailTemplateHeader);

            foreach (array_keys($swap_var) as $key) {
                if (strlen($key) > 2 && trim($key) != '') {
                    $header = str_replace($key, $swap_var[$key], $header);
                }
            }

            return $header;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function gatewayBody($message, $link, $buttonName)
    {
        try {
            $swap_var = array(
                "{MESSAGE}" => $message,
                "{GATEWAY_URL}" => $link,
                "{BUTTON_NAME}" => $buttonName
            );

            if (!file_exists($this->body)) {
                throw new Exception('Could not find gateway body template.');
            }

            $body = file_get_contents($this->body);

            foreach (array_keys($swap_var) as $key) {
                if (strlen($key) > 2 && trim($key) != '') {
                    if ($swap_var[$key] != '') {
                        $body = str_replace($key, $swap_var[$key], $body);
                    } else {
                        $body = str_replace($key, '', $body);
                    }
                }
            }

            return $body;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function gatewayEmailBody($message, $link, $buttonName)
    {
        try {
            $header = $this->emailHeader();
            $body = $this->gatewayBody($message, $link, $buttonName);
            $footer = $this->emailFooter();

            $fullEmailBody = $header . $body . $footer;

            return $fullEmailBody;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function emailFooter()
    {
        try {
            $swap_var = array(
                "{FACEBOOK}" => $this->facebook,
                "{TWITTER}" => $this->twitter,
                "{CONTACT_EMAIL}" => $this->contact_email,
                "{LINKEDIN}" => $this->linkedin,
                "{INSTAGRAM}" => $this->instagram,
                "{YEAR}" => $this->year,
                "{COMPANY_NAME}" => $this->company_name
            );

            if (file_exists($this->emailTemplateFooter)) {
                throw new Exception('Unable to locate contact email template.');
            }

            $footer = file_get_contents($this->emailTemplateFooter);

            foreach (array_keys($swap_var) as $key) {
                if (strlen($key) > 2 && trim($key) != '') {
                    $footer = str_replace($key, $swap_var[$key], $footer);
                }
            }

            return $footer;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function sendGatewayEmail($user, $subject, $message, $link, $buttonName)
    {
        $to_email = $user->email;
        $name =  $user->name;
        $to_name = $name;

        try {
            $this->mailer->isSMTP();
            $this->mailer->SMTPAuth = $this->smtp_auth;
            $this->mailer->Host = $this->smtp_host;
            $this->mailer->SMTPSecure = $this->smtp_secure;
            $this->mailer->Port = $this->smtp_port;

            $this->mailer->Username = $this->smtp_username;
            $this->mailer->Password = $this->smtp_password;

            $this->mailer->setFrom($this->from_email, $this->from_name);
            $this->mailer->addAddress($to_email, $to_name);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $this->gatewayEmailBody($message, $link, $buttonName);
            $this->mailer->AltBody = '<pre>' . $message . '</pre>';

            $this->mailer->send();

            if ($this->mailer->ErrorInfo) {
                throw new PHPMailerException("Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}");
            }

            return 'Message has been sent';
        } catch (PHPMailerException $e) {
            throw new PHPMailerException($e);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}

