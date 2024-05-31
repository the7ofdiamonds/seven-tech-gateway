<?php

namespace SEVEN_TECH\Gateway\Admin;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\AccountCreate;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use SEVEN_TECH\Gateway\Session\Session;

class AdminAccountManagement
{
    private $parent_slug;
    private $page_title;
    private $menu_title;
    private $menu_slug;
    public $page_url;
    private $createAccount;
    private $session;

    public function __construct(AccountCreate $createAccount)
    {
        $this->parent_slug = (new Admin)->get_parent_slug();
        $this->page_title = 'Account Management';
        $this->menu_title = 'Account';
        $this->menu_slug = (new Admin)->get_menu_slug($this->page_title);
        $this->page_url = (new Admin)->get_plugin_page_url('admin.php', $this->menu_slug);
        $this->createAccount = $createAccount;
        $this->session = new Session;

        add_action('wp_ajax_createAccount', [$this, 'createAccount']);
        add_action('wp_ajax_findAccount', [$this, 'findAccount']);
        add_action('wp_ajax_getSessions', [$this, 'getSessions']);
        add_action('wp_ajax_removeSession', [$this, 'removeSession']);
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
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    public function findAccount()
    {
        try {
            $email = $_POST['email'];

            $account = (new Account($email));

            wp_send_json_success($account);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    public function getSessions()
    {
        try {
            $id = $_POST['id'];

            $sessions = $this->session->getSessions($id);

            wp_send_json_success($sessions);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    public function removeSession()
    {
        try {
            $verifier = $_POST['verifier'];
            $id = $_POST['id'];

            $removedSession = $this->session->destroy_session($id, $verifier);

            wp_send_json_success($removedSession);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    // This should be added to communications
    public function sendSubscriptionEmail()
    {
        try {
            $email = $_POST['email'];

            $message = "An email has been sent to {$email} check your inbox for directions on how and where to renew subscriptions.";

            wp_send_json_success($message);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    // Send account locked email
    public function lockAccount()
    {
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $lockedAccount = (new Account($email))->lockAccount($password);

            wp_send_json_success($lockedAccount);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function unlockAccount()
    {
        try {
            $email = $_POST['email'];
            $userActivationCode = $_POST['userActivationCode'];

            $unlockedAccount = (new Account($email))->unlockAccount($userActivationCode);

            wp_send_json_success($unlockedAccount);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    // Send account removed email
    // Account should be locked before being disabled
    function disableAccount()
    {
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $disabledAccount = (new Account($email))->disableAccount($password);

            wp_send_json_success($disabledAccount);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    // Send account enabled email
    function enableAccount()
    {
        try {
            $email = $_POST['email'];
            $userActivationCode = $_POST['userActivationCode'];

            $enabledAccount = (new Account($email))->enableAccount($userActivationCode);

            wp_send_json_success($enabledAccount);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    // Send Account deleted email
    function deleteAccount()
    {
        try {
            $email = $_POST['email'];

            $deletedAccount = (new Account($email))->deleteAccount($email);

            wp_send_json_success($deletedAccount);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }
}
