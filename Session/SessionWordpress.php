<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class SessionWordpress
{

    function getSessions($id)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required.', 400);
            }

            $session_tokens = get_user_meta($id, 'session_tokens');

            if (!isset($session_tokens[0])) {
                return false;
            }

            return $session_tokens[0];
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function createSession(string $verifier, Session $session)
    {
        try {
            $session_tokens = $this->getSessions($session->id);

            $session_token = array(
                'expiration' => $session->expiration,
                'ip' => $session->ip,
                'ua' => $session->user_agent,
                'login' => $session->login
            );

            if (!$session_tokens) {
                $session_tokens = [];
            }

            $session_tokens[$verifier] = $session_token;

            $serializedSessions = serialize($session_tokens);

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL createSession('%s', '%s')", $session->id, $serializedSessions)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $sessionCreated = $results[0]->resultSet;

            if ($sessionCreated == 'FALSE') {
                throw new Exception('Password could not be updated at this time.', 400);
            }

            return $sessionCreated;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function findSession($id, $session_verifier)
    {
        $session = false;

        $session_tokens = $this->getSessions($id);

        if (empty($session_tokens)) {
            return $session;
        }

        foreach ($session_tokens as $session_key => $session_value) {
            if ((new Validator)->matches($session_key, $session_verifier)) {
                $session = $session_value;
                break;
            }
        }

        return $session;
    }

    function updateSession($id, $session_verifier)
    {
        $session = $this->findSession($id, $session_verifier);

        error_log(print_r($session, true));
    }

    function deleteSession($id, $verifier)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required to destroy session.', 400);
            }

            if (empty($verifier)) {
                throw new Exception('Verifier is required to destroy session.', 400);
            }

            $session_tokens = $this->getSessions($id);

            if (!is_array($session_tokens)) {
                return;
            }

            foreach ($session_tokens as $key => $value) {
                if ($key == $verifier) {
                    unset($session_tokens[$key]);
                    break;
                }
            }

            $session_destroyed = update_user_meta($id, 'session_tokens', $session_tokens);

            return $session_destroyed;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
