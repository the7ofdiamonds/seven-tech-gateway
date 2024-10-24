<?php

namespace SEVEN_TECH\Gateway\Change;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use SEVEN_TECH\Communications\Email\Gateway\Change as GatewayChange;

use Exception;

use WP_User;

class Change {
    public $id;
    public $email;
    public $status;
    public $username;
    public $firstname;
    public $lastname;
    public $nickname;
    public $nicename;
    public $phone;
    public $url;
    private $WPUser;

    public function __construct(string $email)
    {
        try {
            $account = (new Account($email));

            $this->id = $account->id;
            $this->email = $account->email;
            $this->username = $account->username;
            $this->firstname = $account->firstName;
            $this->lastname = $account->lastName;
            $this->nickname = $account->nickname;
            $this->nicename = $account->nicename;
            $this->phone = $account->phone;

            $this->WPUser = new WP_User($this->id);
            $this->status = $this->WPUser->user_status;
            $this->url = $this->WPUser->user_url;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function username(String $username)
    {
        try {

            if (empty($username)) {
                throw new Exception('Username is required.', 400);
            }

            $this->WPUser->display_name = $username;

            $updatedUser = wp_update_user($this->WPUser);

            if (is_wp_error($updatedUser)) {
                throw new Exception($updatedUser->get_error_message());
            }

            if (class_exists(GatewayChange::class, true)) {
                (new GatewayChange())->sendUsernameChangedEmail($this->id, $username);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function nicename(String $nicename)
    {
        try {

            if (empty($nicename)) {
                throw new Exception('Nicename is required to change nicename.', 400);
            }

            $this->WPUser->nicename = $nicename;

            $updatedUser = wp_update_user($this->WPUser);

            if (is_wp_error($updatedUser)) {
                throw new Exception($updatedUser->get_error_message());
            }

            if (class_exists(GatewayChange::class, true)) {
                (new GatewayChange())->sendNicenameChangedEmail($this->id, $nicename);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function nickname(String $nickname)
    {
        try {

            if (empty($nickname)) {
                throw new Exception('Nick name is required to change nick name.', 400);
            }

            $this->WPUser->nickname = $nickname;

            $updatedUser = wp_update_user($this->WPUser);

            if (is_wp_error($updatedUser)) {
                throw new Exception($updatedUser->get_error_message());
            }

            if (class_exists(GatewayChange::class, true)) {
                (new GatewayChange())->sendNicknameChangedEmail($this->id, $nickname);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function firstName(String $firstname)
    {
        try {

            if (empty($firstname)) {
                throw new Exception('First name is required to change first name.', 400);
            }

            $this->WPUser->first_name = $firstname;

            $updatedUser = wp_update_user($this->WPUser);

            if (is_wp_error($updatedUser)) {
                throw new Exception($updatedUser->get_error_message());
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function lastName(String $lastname)
    {
        try {

            if (empty($lastname)) {
                throw new Exception('Last name is required.', 400);
            }

            $this->WPUser->last_name = $lastname;

            $updatedUser = wp_update_user($this->WPUser);

            if (is_wp_error($updatedUser)) {
                throw new Exception($updatedUser->get_error_message());
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function name(String $firstname, String $lastname)
    {
        try {

            if (!empty($firstname)) {
                $this->firstName($firstname);
            }

            if (!empty($lastname)) {
                $this->lastName($lastname);
            }

            if (class_exists(GatewayChange::class, true)) {
                (new GatewayChange())->sendNameChangedEmail($this->id);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function phone(string $phone)
    {
        try {

            if (empty($phone)) {
                throw new Exception('Phone number is required to change phone number.', 400);
            }

            $this->WPUser->phone = $phone;

            $updatedUser = wp_update_user($this->WPUser);

            if (is_wp_error($updatedUser)) {
                throw new Exception($updatedUser->get_error_message());
            }

            if (class_exists(GatewayChange::class, true)) {
                (new GatewayChange())->sendPhoneChangedEmail($this->id, $phone);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}