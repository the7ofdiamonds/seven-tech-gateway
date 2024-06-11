<?php

namespace SEVEN_TECH\Gateway\Admin;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Session\Session;

use Exception;

class AdminSessionManagement
{
    private $parent_slug;
    private $page_title;
    private $menu_title;
    private $menu_slug;
    public $page_url;

    public function __construct()
    {
        $this->parent_slug = (new Admin)->get_parent_slug();
        $this->page_title = 'Session Management';
        $this->menu_title = 'Session';
        $this->menu_slug = (new Admin)->get_menu_slug($this->page_title);
        $this->page_url = (new Admin)->get_plugin_page_url('admin.php', $this->menu_slug);

        add_action('wp_ajax_findSession', [$this, 'findSession']);
        add_action('wp_ajax_getSessions', [$this, 'getSessions']);
        add_action('wp_ajax_removeSession', [$this, 'removeSession']);
        add_action('wp_ajax_lengthSession', [$this, 'lengthSession']);
    }

    function register_custom_submenu_page()
    {
        add_submenu_page($this->parent_slug, $this->page_title, $this->menu_title, 'manage_options', $this->menu_slug, [$this, 'create_section'], 4);
        add_settings_section('seven-tech_admin_session_management', $this->page_title, [$this, 'section_description'], $this->menu_slug);
    }

    function create_section()
    {
        include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-session-management.php';
    }

    function section_description()
    {
        echo 'Manage Sessions';
    }

    function findSession()
    {
        try {
            $verifier = $_POST['verifier'];

            $session = (new Session)->findSession($verifier);

            wp_send_json_success($session);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    public function getSessions()
    {
        try {
            $email = $_POST['email'];

            $sessions = (new Session)->getSessions($email);

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

            $removedSession = (new Session)->deleteSession($id, $verifier);

            wp_send_json_success($removedSession);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function lengthSession()
    {
        try {
            $length = $_POST['length'];

            $savedLength = get_option('session_length');

            if ($savedLength == $length) {
                throw new Exception("Session expiration is the same at {$length} seconds.", 400);
            }

            $updated = update_option('session_length', $length);

            if (!$updated) {
                throw new Exception('Session expiration could not be updated.', 500);
            }

            $successMsg = "Session Expiration has been updated to {$length} seconds";

            wp_send_json_success($successMsg);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }
}
