<?php

namespace SEVEN_TECH\Gateway\User;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailUser;

use Exception;

use WP_User;

class User
{
    public $id;
    public $email;
    public $join_date;
    public $status;
    public $username;
    public $firstname;
    public $lastname;
    public $nickname;
    public $nicename;
    public $roles;
    public $phone;
    public $url;

    public function __construct(string $username)
    {
        try {
            $user_data = new WP_User(0, $username);

            if (empty($user_data->ID)) {
                throw new Exception('User could not be found.', 404);
            }

            $this->id = $user_data->ID;
            $this->email = $user_data->data->user_email;
            $this->join_date = $user_data->data->user_registered;
            $this->status = $user_data->data->user_status;
            $this->username = $user_data->data->display_name;
            $this->firstname = get_user_meta($this->id, 'first_name');
            $this->lastname = get_user_meta($this->id, 'last_name');
            $this->nickname = get_user_meta($this->id, 'nickname');
            $this->nicename = $user_data->data->user_nicename;
            $this->roles = $this->getUserRoles($user_data->roles);
            $this->phone = get_user_meta($this->id, 'phone_number');
            $this->url = $user_data->data->user_url;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function getUserRoles($roles)
    {
        try {
            $wp_roles = wp_roles()->get_names();

            $user_roles = [];

            foreach ($wp_roles as $roleKey => $roleValue) {
                foreach ($roles as $role) {
                    if ($roleKey == $role) {
                        $user_roles[] = [
                            'name' => $roleKey,
                            'display_name' => $roleValue
                        ];
                    }
                }
            }

            return $user_roles;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
