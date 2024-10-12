<?php

namespace SEVEN_TECH\Gateway\Email;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

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
    private $logo_link;
    public $site_name;
    private $facebook;
    private $twitter;
    private $contact_email;
    private $linkedin;
    private $instagram;
    private $year;
    public $company_name;
    private $emailTemplateHeader;
    private $emailTemplateFooter;
    public $support_email;

    public function __construct()
    {
        $this->smtp_host = get_option('quote_smtp_host');
        $this->smtp_port = get_option('quote_smtp_port');
        $this->smtp_secure = get_option('quote_smtp_secure');
        $this->smtp_auth = get_option('quote_smtp_auth');
        $this->smtp_username = get_option('quote_smtp_username');
        $this->smtp_password = get_option('quote_smtp_password');
        $this->from_email = get_option('quote_email');
        $this->from_name = get_option('quote_name');

        $this->mailer = new PHPMailer();

        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
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
        $this->emailTemplateFooter = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailFooter.php';

        $this->support_email = get_option('support_email') ? get_option('support_email') : get_option('admin_email');
    }

    public function emailHeader()
    {
        try {
            $swap_var = array(
                "{WEB_ADDRESS}" => home_url(),
                "{LOGO_LINK}" => $this->logo_link,
                "{SITE_NAME}" => $this->site_name,
            );

            $fileExists = file_exists($this->emailTemplateHeader);

            if (!$fileExists) {
                throw new Exception("Unable to locate email header template at {$this->emailTemplateHeader}.", 404);
            }

            $header = file_get_contents($this->emailTemplateHeader);

            foreach (array_keys($swap_var) as $key) {
                if (strlen($key) > 2 && trim($key) != '') {
                    $header = str_replace($key, $swap_var[$key], $header);
                }
            }

            return $header;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function emailBody(string $template, array $content)
    {
        try {
            $header = $this->emailHeader();

            $fileExists = file_exists($template);

            if (!$fileExists) {
                throw new Exception("Could not find body template at {$template}.", 404);
            }

            $body = file_get_contents($template);

            foreach (array_keys($content) as $key) {
                if (strlen($key) > 2 && trim($key) != '') {
                    if ($content[$key] != '') {
                        $body = str_replace($key, $content[$key], $body);
                    } else {
                        $body = str_replace($key, '', $body);
                    }
                }
            }

            $footer = $this->emailFooter();

            $fullEmailBody = $header . $body . $footer;

            return $fullEmailBody;
        } catch (Exception $e) {
            throw new DestructuredException($e);
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

            $fileExists = file_exists($this->emailTemplateFooter);

            if (!$fileExists) {
                throw new Exception("Unable to locate email footer template at {$this->emailTemplateFooter}.", 404);
            }

            $footer = file_get_contents($this->emailTemplateFooter);

            foreach (array_keys($swap_var) as $key) {
                if (strlen($key) > 2 && trim($key) != '') {
                    $footer = str_replace($key, $swap_var[$key], $footer);
                }
            }

            return $footer;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function sendEmail(Account $account, string $subject, string $template, array $content, string $message): bool
    {
        try {

            if (
                !$this->smtp_host ||
                !$this->smtp_port ||
                !$this->smtp_secure ||
                !$this->smtp_auth ||
                !$this->smtp_username ||
                !$this->smtp_password ||
                !$this->from_email ||
                !$this->from_name
            ) {
                error_log("Some or all email host settings are not present.");
                return false;
            }

            $to_email = $account->email;
            $name =  "{$account->firstName} {$account->lastName}";
            $to_name = $name;

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
            $this->mailer->Body = $this->emailBody($template, $content);
            $this->mailer->AltBody = '<pre>' . $message . '</pre>';

            $this->mailer->send();

            if ($this->mailer->ErrorInfo) {
                throw new PHPMailerException("Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}", 500);
            }

            return true;
        } catch (PHPMailerException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
