<?php

namespace SEVEN_TECH\Menus;

class Menus
{

    public function __construct()
    {
    }

    function create_mobile_menu()
    {
        $menu_name = 'Mobile';
        $menu_object = wp_get_nav_menu_object($menu_name);

        if (!$menu_object) {
            wp_create_nav_menu($menu_name);
            $this->add_to_mobile_menu();
        } else {
            $this->add_to_mobile_menu();
        }
    }

    function add_to_mobile_menu()
    {
        $menu_name = 'Mobile';
        $menu_object = wp_get_nav_menu_object($menu_name);

        if ($menu_object) {
            $menu_id = $menu_object->term_id;
            $existing_menu_items = wp_get_nav_menu_items($menu_id);
            $menu_item_exists = false;

            foreach ($existing_menu_items as $item) {
                if ($item->title === 'DASHOBOARD') {
                    $menu_item_exists = true;
                    break;
                }
            }

            if (!$menu_item_exists) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => 'DASHBOARD',
                    'menu-item-url' => '/dashboard',
                    'menu-item-status' => 'publish',
                    'menu-item-position' => 60
                ));
            }
        }
    }
}
