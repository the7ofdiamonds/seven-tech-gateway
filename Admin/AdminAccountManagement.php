<?php

namespace SEVEN_TECH\Gateway\Admin;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\AccountCreate;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

class AdminAccountManagement
{
    private $parent_slug;
    private $page_title;
    private $menu_title;
    private $menu_slug;
    public $page_url;
    private $createAccount;

    public function __construct()
    {
        $this->parent_slug = (new Admin)->get_parent_slug();
        $this->page_title = 'Account Management';
        $this->menu_title = 'Account';
        $this->menu_slug = (new Admin)->get_menu_slug($this->page_title);
        $this->page_url = (new Admin)->get_plugin_page_url('admin.php', $this->menu_slug);
        $this->createAccount = new AccountCreate;

        add_action('wp_ajax_createAccount', [$this, 'createAccount']);
        add_action('wp_ajax_findAccount', [$this, 'findAccount']);
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
        include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-account-management.php';
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

            if (isset($_POST['roles'])) {
                $roles = $_POST['roles'];
            } else {
                $roles = '';
            }

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

    public function lockAccount()
    {
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $lockedAccount = (new Account($email))->lock($password);

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

            $unlockedAccount = (new Account($email))->unlock($userActivationCode);

            wp_send_json_success($unlockedAccount);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function disableAccount()
    {
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $disabledAccount = (new Account($email))->disable($password);

            wp_send_json_success($disabledAccount);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function enableAccount()
    {
        try {
            $email = $_POST['email'];
            $userActivationCode = $_POST['userActivationCode'];

            $enabledAccount = (new Account($email))->enable($userActivationCode);

            wp_send_json_success($enabledAccount);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function deleteAccount()
    {
        try {
            $email = $_POST['email'];

            $deletedAccount = (new Admin())->deleteAccount($email);

            wp_send_json_success($deletedAccount);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }
}
