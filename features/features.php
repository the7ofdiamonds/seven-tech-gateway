<?php

include 'widgets/widgets.php';
include 'admin/admin-team.php';

class THFW_Users_Features {

    public function __construct() {
        new THFW_Users_Widgets();
        new THFW_Admin_Team();
    }
}