<?php

namespace SEVEN_TECH\Gateway\Admin;

use Exception;
use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\CreateAccount;

class AdminAccountManagement
{
    private $parent_slug;
    private $page_title;
    private $menu_title;
    private $menu_slug;
    public $page_url;
    private $createAccount;

    public function __construct(CreateAccount $createAccount)
    {
        $this->parent_slug = (new Admin)->get_parent_slug();
        $this->page_title = 'Account Management';
        $this->menu_title = 'Account';
        $this->menu_slug = (new Admin)->get_menu_slug($this->page_title);
        $this->page_url = (new Admin)->get_plugin_page_url('admin.php', $this->menu_slug);
        $this->createAccount = $createAccount;

        add_action('wp_ajax_createAccount', [$this, 'createAccount']);
        add_action('wp_ajax_findAccount', [$this, 'findAccount']);
        add_action('wp_ajax_getAccountStatus', [$this, 'getAccountStatus']);
        add_action('wp_ajax_sendSubscriptionEmail', [$this, 'sendSubscriptionEmail']);
        add_action('wp_ajax_lockAccount', [$this, 'lockAccount']);
        add_action('wp_ajax_unlockAccount', [$this, 'unlockAccount']);
        add_action('wp_ajax_enableAccount', [$this, 'enableAccount']);
        add_action('wp_ajax_disableAccount', [$this, 'disableAccount']);
        add_action('wp_ajax_deleteAccount', [$this, 'deleteAccount']);
    }

    function register_custom_submenu_page()
    {
        add_submenu_page($this->parent_slug, $this->page_title, $this->menu_title, 'manage_options', $this->menu_slug, [$this, 'create_section'], 4);
        add_settings_section('seven-tech_admin_account_management', $this->page_title, [$this, 'section_description'], $this->menu_slug);
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin-account-management.php';
    }

    function section_description()
    {
        echo 'Manage User Accounts';
    }

    public function createAccount()
    {
        try {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $nicename = $_POST['nicename'];
            $nickname = $_POST['nickname'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];
            $roles = $_POST['roles'];

            $createdAccount = $this->createAccount->createAccount($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $roles);

            wp_send_json_success($createdAccount);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }

    public function findAccount()
    {
        try {
            $email = $_POST['email'];

            $account = new Account($email);

            wp_send_json_success($account);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }

    public function getAccountStatus()
    {
        try {
            $email = $_POST['email'];

            $accountStatus = new Account($email);
            error_log(print_r($accountStatus->getAccountStatus(), true));
            wp_send_json_success($accountStatus);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }

    // This should be added to communications
    public function sendSubscriptionEmail()
    {
        try {
            $email = $_POST['email'];

            $message = "An email has been sent to {$email} check your inbox for directions on how and where to renew subscriptions.";

            wp_send_json_success($message);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }

    // Send account locked email
    public function lockAccount()
    {
        try {
            $email = $_POST['email'];
            $confirmationCode = $_POST['confirmationCode'];

            $lockedAccount = (new Account($email))->lockAccount($confirmationCode);

            wp_send_json_success($lockedAccount);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }

    function unlockAccount()
    {
        try {
            $email = $_POST['email'];
            $confirmationCode = $_POST['confirmationCode'];

            $unlockedAccount = (new Account($email))->unlockAccount($confirmationCode);

            wp_send_json_success($unlockedAccount);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }

    // Send account removed email
    // Account should be locked before being disabled
    function disableAccount()
    {
        try {
            $email = $_POST['email'];
            $confirmationCode = $_POST['confirmationCode'];

            $disabledAccount = (new Account($email))->disableAccount($confirmationCode);

            wp_send_json_success($disabledAccount);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }

    // Send account enabled email
    function enableAccount()
    {
        try {
            $email = $_POST['email'];
            $confirmationCode = $_POST['confirmationCode'];

            $enabledAccount = (new Account($email))->enableAccount($confirmationCode);

            wp_send_json_success($enabledAccount);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }

    // Send Account deleted email
    function deleteAccount()
    {
        try {
            if (!isset($_POST['email'])) {
                throw new Exception('Email is required.', 400);
            }

            $email = $_POST['email'];

            $account = (new Account($email))->findAccount();

            $is_enabled = $account->is_enabled;

            if (!is_numeric($is_enabled) || $is_enabled == 1) {
                throw new Exception('Account must first be removed.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL deleteAccount('%s')", $email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->result) || !$results[0]->result) {
                throw new Exception('Account could not be deleted at this time.', 500);
            }

            $message = 'Account deleted succesfully.';

            wp_send_json_success($message);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }
}
