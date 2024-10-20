<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class Details
{

    public function addDetails($id, $metaKey, $metaValue): bool
    {
        try {
            $detailsAdded = add_user_meta($id, $metaKey, $metaValue);

            if (!$detailsAdded) {
                throw new Exception('Account details could not be added.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isAuthenticated(Account $account)
    {
        try {

            if ($account->isAuthenticated) {
                return true;
            }

            $isAuthenticated = update_user_meta($account->id, 'is_authenticated', 1);

            if (!$isAuthenticated) {
                throw new Exception('Account could not be authenticated.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isNotAuthenticated(Account $account)
    {
        try {

            if (!$account->isAuthenticated) {
                return true;
            }

            $isNotAuthenticated = update_user_meta($account->id, 'is_authenticated', 0);

            if (!$isNotAuthenticated) {
                throw new Exception('Account could not be authenticated.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function expireCredentials(Account $account)
    {
        try {

            if (!$account->isCredentialsNonExpired) {
                return true;
            }

            $credentialsExpired = update_user_meta($account->id, 'is_credentials_non_expired', 0);

            if (!$credentialsExpired) {
                throw new Exception('Account credentials could not be expired.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unexpireCredentials(Account $account)
    {
        try {

            if ($account->isCredentialsNonExpired) {
                return true;
            }

            $credentialsUnexpired = update_user_meta($account->id, 'is_credentials_non_expired', 1);

            if (!$credentialsUnexpired) {
                throw new Exception('Account credentials could not be unexpired.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function lockAccount(Account $account)
    {
        try {

            if (!$account->isAccountNonLocked) {
                return true;
            }

            $accountLocked = update_user_meta($account->id, 'is_account_non_locked', 0);

            if (!$accountLocked) {
                throw new Exception('Account could not be locked.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unlockAccount(Account $account)
    {
        try {

            if ($account->isAccountNonLocked) {
                return true;
            }

            $accountUnlocked = update_user_meta($account->id, 'is_account_non_locked', 1);

            if (!$accountUnlocked) {
                throw new Exception('Account could not be unlocked.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function disableAccount(Account $account)
    {
        try {

            if (!$account->isEnabled) {
                return true;
            }

            $accountDisabled = update_user_meta($account->id, 'is_enabled', 0);

            if (!$accountDisabled) {
                throw new Exception('Account could not be disabled.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function enableAccount(Account $account)
    {
        try {

            if ($account->isEnabled) {
                return true;
            }

            $accountEnabled = update_user_meta($account->id, 'is_enabled', 1);

            if (!$accountEnabled) {
                throw new Exception('Account could not be enabled.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function expireAccount(Account $account)
    {
        try {

            if (!$account->isAccountNonExpired) {
                return true;
            }

            $accountExpired = update_user_meta($account->id, 'is_account_non_expired', 0);

            if (!$accountExpired) {
                throw new Exception('Account could not be expired.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unexpireAccount(Account $account)
    {
        try {

            if ($account->isAccountNonExpired) {
                return true;
            }

            $accountUnexpired = update_user_meta($account->id, 'is_account_non_expired', 1);

            if (!$accountUnexpired) {
                throw new Exception('Account could not be unexpired.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
