<?php

namespace SEVEN_TECH\Gateway\Admin;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Authentication\Logout;
use SEVEN_TECH\Gateway\ENV\ENV;
use SEVEN_TECH\Gateway\Email\EmailAccount;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Services\Google\Google;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;

use Exception;

class Admin
{
    public $admin_url;

    public function __construct()
    {
        $this->admin_url = $this->get_plugin_page_url('admin.php', $this->get_parent_slug());

        add_action('wp_ajax_areGoogleCredentialsPresentAdmin', [$this, 'areGoogleCredentialsPresentAdmin']);
        add_action('wp_ajax_uploadGoogleServiceAccountFile', [$this, 'uploadGoogleServiceAccountFile']);
        add_action('wp_ajax_uploadENVFile', [$this, 'uploadENVFile']);
    }

    public function get_parent_slug()
    {
        return strtolower(str_replace(' ', '-', PLUGIN_NAME));
    }

    function get_plugin_page_url($filename, $slug)
    {
        $plugin_page_url = admin_url("{$filename}?page={$slug}");

        return $plugin_page_url;
    }

    public function settings_link($links)
    {
        $settings_link = "<a href='{$this->admin_url}'>Settings</a>";
        array_push($links, $settings_link);

        return $links;
    }

    function get_menu_slug($title)
    {
        $slug = strtolower(str_replace(' ', '-', $title));
        $menu_slug = "{$this->get_parent_slug()}-{$slug}";

        return $menu_slug;
    }

    public function register_custom_menu_page()
    {
        add_menu_page(
            PLUGIN_NAME,
            'GATEWAY',
            'manage_options',
            $this->get_parent_slug(),
            '',
            'dashicons-info',
            101
        );
        add_submenu_page(
            $this->get_parent_slug(),
            PLUGIN_NAME,
            'Dashboard',
            'manage_options',
            $this->get_parent_slug(),
            [$this, 'create_section'],
            0
        );
        add_settings_section('seven_tech_admin_group', PLUGIN_NAME, '', $this->get_parent_slug());
    }

    function create_section()
    {
        include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin.php';
    }

    function section_description()
    {
        echo 'Manage User Accounts';
    }

    public function areGoogleCredentialsPresentAdmin()
    {
        try {
            $credentialsPresent = (new Google)->serviceAccountIsValid;

            wp_send_json_success($credentialsPresent);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    public function uploadGoogleServiceAccountFile()
    {
        try {
            foreach ($_FILES as $file) {
                $uploadedGoogleServiceAccountFile = (new Google)->uploadServiceAccountFile($file);
            }

            wp_send_json_success($uploadedGoogleServiceAccountFile);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    public function uploadENVFile()
    {
        try {
            foreach ($_FILES as $file) {
                $uploadedENVFile = (new ENV)->uploadENVFile($file);
            }

            wp_send_json_success($uploadedENVFile);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function deleteAccount($email)
    {
        try {
            $account = new Account($email);

            if ($account->isAccountNonLocked) {
                throw new Exception('Account must first be locked.', 400);
            }

            if ($account->isAccountNonExpired) {
                throw new Exception('Account must be unsubscribed.', 400);
            }

            if ($account->isCredentialsNonExpired) {
                throw new Exception('Account credentials must be expired.', 400);
            }

            if ($account->isEnabled) {
                throw new Exception('Account must be disabled.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL deleteAccount('%s')", $email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if ($results[0]->result === 'FALSE') {
                throw new Exception('Account could not be deleted at this time.', 500);
            }

            (new FirebaseAuth)->deleteUser($account->providerGivenID);

            (new Logout())->all($account);

            // (new EmailAccount)->accountDeleted($email);

            return 'Account deleted succesfully.';
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
