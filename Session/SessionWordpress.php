<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class SessionWordpress
{

    function get(int $user_id): array
    {
        try {
            $sessions = [];

            if (empty($user_id)) {
                throw new Exception('User ID is required.', 400);
            }

            $session_tokens = get_user_meta($user_id, 'session_tokens', true);

            if (empty($session_tokens) || $session_tokens == null) {
                return $sessions;
            }

            if (is_serialized($session_tokens)) {
                $sessions = unserialize($session_tokens);

                if ($sessions === false) {
                    throw new Exception('Failed to unserialize session tokens for user ID: ' . $user_id);
                }
            }

            if (is_array($session_tokens)) {
                $sessions = $session_tokens;
            }

            return $sessions;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function create(Session $session): bool
    {
        try {
            $session_tokens = $this->get($session->user_id);

            if (!is_array($session_tokens) || $session_tokens == false || $session_tokens == '') {
                $session_tokens = [];
            }

            $session_token = array(
                'expiration' => $session->expiration,
                'ip' => $session->ip,
                'ua' => $session->user_agent,
                'login' => $session->login
            );

            $session_tokens[$session->id] = $session_token;

            $serializedSessions = serialize($session_tokens);

            $sessionCreated = update_user_meta($session->user_id, 'session_tokens', $serializedSessions);

            if ($sessionCreated == false) {
                throw new Exception('Session could not be created at this time.', 400);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function find(int $user_id, string $verifier): array
    {
        try {
            $sessionArray = [];

            $session_tokens = $this->get($user_id);

            if (!is_array($session_tokens) || empty($session_tokens)) {
                return $sessionArray;
            }

            $session = [];

            foreach ($session_tokens as $session_key => $session_value) {
                if ((new Validator)->matches($session_key, $verifier)) {
                    $session = $session_value;
                    break;
                }
            }

            return $session;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function update(Session $session): bool
    {
        try {
            $session_tokens = $this->get($session->user_id);

            if (!is_array($session_tokens)) {
                throw new Exception("Sessions could not be found for updating.");
            }

            if (is_array($session_tokens)) {
                foreach ($session_tokens as $session) {
                    if ((new Validator)->matches($session, $session->id)) {
                        $session['expiration'] = $session->expiration;
                        break;
                    }
                }

                $sessionUpdated = update_user_meta($session->user_id, 'session_tokens', $session_tokens);

                if (empty($sessionUpdated)) {
                    return true;
                }

                return $sessionUpdated;
            }

            $sessionFound = $this->find($session->user_id, $session->id);

            if (is_array($sessionFound)) {
                error_log($sessionFound['expiration']);
                if ($sessionFound['expiration'] == $session->expiration) {
                    return true;
                }
            }

            return false;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function delete(Session $session): bool
    {
        try {
            if (empty($session->user_id)) {
                throw new Exception('ID is required to destroy session.', 400);
            }

            if (empty($session->id)) {
                throw new Exception('Verifier is required to destroy session.', 400);
            }

            $session_tokens = $this->get($session->user_id);

            if (!is_array($session_tokens)) {
                return true;
            }

            if (is_array($session_tokens)) {
                foreach ($session_tokens as $key => $value) {
                    if ((new Validator)->matches($key, $session->id)) {
                        unset($session_tokens[$key]);
                        break;
                    }
                }

                if (empty($session_tokens)) {
                    $sessionsDeleted = delete_user_meta($session->user_id, 'session_tokens');

                    if ($sessionsDeleted == false) {
                        throw new Exception("Sessions could not be deleted.");
                    }

                    return $sessionsDeleted;
                }
            }

            $sessionUpdated = update_user_meta($session->user_id, 'session_tokens', $session_tokens);

            if (is_int($sessionUpdated) || $sessionUpdated == false) {
                return false;
            }

            $sessionFound = $this->find($session->user_id, $session->id);

            if (is_array($sessionFound)) {
                return false;
            }

            return $sessionUpdated;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
