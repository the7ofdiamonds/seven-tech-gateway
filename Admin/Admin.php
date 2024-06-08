<?php

namespace SEVEN_TECH\Gateway\Admin;

use SEVEN_TECH\Gateway\Configuration\Configuration;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Auth;

class Admin
{
    public $admin_url;

    public function __construct()
    {
        $this->admin_url = $this->get_plugin_page_url('admin.php', $this->get_parent_slug());

        add_action('wp_ajax_areGoogleCredentialsPresentAdmin', [$this, 'areGoogleCredentialsPresentAdmin']);
        add_action('wp_ajax_uploadFile', [$this, 'uploadFile']);
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

    public function areGoogleCredentialsPresent()
    {
        try {
            if (!file_exists(GOOGLE_SERVICE_ACCOUNT)) {
                throw new Exception('Google service account file does not exist.', 400);
            }

            $jsonFileContents = file_get_contents(GOOGLE_SERVICE_ACCOUNT);

            if ($jsonFileContents === false) {
                throw new Exception('Unable to read Google service account file.', 400);
            }

            $decodedData = json_decode($jsonFileContents, true);

            $missingFields = [];
            $requiredFields = ['type', 'project_id', 'private_key_id', 'private_key', 'client_email', 'client_id', 'auth_uri', 'token_uri', 'auth_provider_x509_cert_url', 'client_x509_cert_url', 'universe_domain'];

            foreach ($requiredFields as $field) {
                if (!isset($decodedData[$field])) {
                    $missingFields[] = $field;
                }
            }

            if (!empty($missingFields)) {
                $errorMessage = 'Required fields are missing: ' . implode(', ', $missingFields);
                throw new Exception($errorMessage, 400);
            }

            if ($decodedData['type'] !== 'service_account') {
                throw new Exception('Type is not set to service_account.', 400);
            }

            $factory = (new Factory)->withServiceAccount(GOOGLE_SERVICE_ACCOUNT);

            return $factory->createAuth();
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function areGoogleCredentialsPresentAdmin()
    {
        try {
            $credentialsPresent = $this->areGoogleCredentialsPresent();

            if ($credentialsPresent instanceof Auth) {
                $credentialsPresent = true;
            }

            wp_send_json_success($credentialsPresent);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        } 
    }

    // Upload google credentrials
    public function uploadFile()
    {
        try {
            foreach ($_FILES as $file) {
                $uploadedFile = (new Configuration)->uploadConfigFile($file);
            }

            wp_send_json_success($uploadedFile);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }

    // upload redis credentials
}
