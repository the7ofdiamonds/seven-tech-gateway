<?php

namespace SEVEN_TECH\Gateway\Admin;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use SEVEN_TECH\Gateway\Session\Session;

class AdminSessionManagement
{
    private $parent_slug;
    private $page_title;
    private $menu_title;
    private $menu_slug;
    public $page_url;
    private $session;

    public function __construct()
    {
        $this->parent_slug = (new Admin)->get_parent_slug();
        $this->page_title = 'Session Management';
        $this->menu_title = 'Session';
        $this->menu_slug = (new Admin)->get_menu_slug($this->page_title);
        $this->page_url = (new Admin)->get_plugin_page_url('admin.php', $this->menu_slug);
        $this->session = new Session;

        add_action('wp_ajax_getSessions', [$this, 'getSessions']);
        add_action('wp_ajax_removeSession', [$this, 'removeSession']);
    }

    function register_custom_submenu_page()
    {
        add_submenu_page($this->parent_slug, $this->page_title, $this->menu_title, 'manage_options', $this->menu_slug, [$this, 'create_section'], 4);
        add_settings_section('seven-tech_admin_session_management', $this->page_title, [$this, 'section_description'], $this->menu_slug);
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin-session-management.php';
    }

    function section_description()
    {
        echo 'Manage Sessions';
    }

    public function getSessions()
    {
        try {
            $email = $_POST['email'];
            $user = get_user_by('email', $email);
            $id = $user->ID;
            $sessions = $this->session->getSessions($id);

            $accountSessions = array('id' => $id, 'sessions' => $sessions);

            wp_send_json_success($accountSessions);
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
}
