<?php

namespace SEVEN_TECH\Database;

class Database
{
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

    }

    function createTables()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    }
}
