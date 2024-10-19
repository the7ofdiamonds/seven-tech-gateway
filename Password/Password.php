<?php

namespace SEVEN_TECH\Gateway\Password;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Email\EmailPassword;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class Password
{
    private $validator;
    private $email;
    private $firebaseAuth;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->email = new EmailPassword;
        $this->firebaseAuth = new FirebaseAuth;
    }

    function frag(string $password): string
    {
        return substr($password, 8, 4);
    }

    function hash(string $password): string
    {
        $this->validator->isValidPassword($password);

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        return $hashedPassword;
    }

    function matchesHash(string $password, string $hash): bool
    {
        $this->validator->isValidPassword($password);

        $first_two_chars = substr($hash, 0, 2);

        if ($first_two_chars === '$P') {
            $password_check = wp_check_password($password, $hash);
        } else {
            $password_check = password_verify($password, $hash);
        }

        if (!$password_check) {
            throw new Exception('The password you entered is not correct.', 400);
        }

        return $password_check;
    }

    function match(string $password, string $confirmPassword)
    {
        try {
            if (empty($password)) {
                throw new Exception('Enter your new preferred password.', 400);
            }

            if (empty($confirmPassword)) {
                throw new Exception('Enter your new preferred password twice.', 400);
            }

            $this->validator->isValidPassword($password);
            $this->validator->isValidPassword($password);

            $matches = $this->validator->matches($password, $confirmPassword);

            if (!$matches) {
                throw new Exception('Enter your new preferred password exactly the same twice.', 400);
            }

            return $matches;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function recover(string $email)
    {
        try {
            $account = new Account($email);

            $auth = new Authentication($email);

            $password_recover_link = home_url() . "/password/recover/{$account->email}/{$auth->confirmationCode}";

            // $this->email->recover($account, $password_recover_link);

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function persist(Account $account, $password, $confirmPassword): bool
    {
        try {
            $this->match($password, $confirmPassword);

            $hashedPassword = $this->hash($password);

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changePassword('$account->email', '$hashedPassword')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $passwordChanged = $results[0]->resultSet;

            if ($passwordChanged == 'FALSE') {
                throw new Exception('Password could not be updated at this time.', 400);
            }

            $this->firebaseAuth->changeFirebasePassword($account->providerGivenID, $password);

            if (!$account->isCredentialsNonExpired) {
                (new Details($account->email))->unexpireCredentials($account);
            }

            // $this->email->changed($account);

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function change(string $email, string $password, string $confirmPassword)
    {
        try {
            $account = new Account($email);

            $this->persist($account, $password, $confirmPassword);

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function update(string $email)
    {
        try {
            $account = new Account($email);

            $password_update_link = home_url() . "/password/update/{$account->email}/{$account->confirmationCode}";

            $this->email->update($account, $password_update_link);

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function updated(string $email, string $confirmationCode, string $password, string $confirmPassword)
    {
        try {
            $account = new Account($email);

            $auth = new Authentication($account->email);
            $auth->verifyCredentials($confirmationCode);

            $this->persist($account, $password, $confirmPassword);

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
