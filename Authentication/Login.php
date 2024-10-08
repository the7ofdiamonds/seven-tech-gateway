<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Cookie\Cookie;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Session\SessionCreate;
use SEVEN_TECH\Gateway\Token\Token;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

use Exception;

use WP_REST_Request;

class Login
{
    private $firebaseAuth;
    private $token;

    public function __construct()
    {
        $this->firebaseAuth = new FirebaseAuth;
        $this->token = new Token;
    }

    function signInWithEmailAndPassword($email, $password)
    {
        try {          
            $account = new Account($email);

            if ($password !== '') {
                (new Password)->passwordMatchesHash($password, $account->password);
            }

            (new Details($email))->isAuthenticated();
            $signedInUser = $this->firebaseAuth->signInWithEmailAndPassword($email, $password);

            return new Authenticated($signedInUser->idToken(), $signedInUser->refreshToken());
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function signInWithRefreshToken(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getAccessToken($request);
            $refreshToken = $this->token->getRefreshToken($request);
            $email = $this->token->getEmailFromToken($accessToken);
            (new Details($email))->isAuthenticated();

            return new Authenticated($accessToken, $refreshToken);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function signIn(WP_REST_Request $request)
    {
        try {
            $authenticatedAccount = '';
            
            if (isset($request['email']) && isset($request['password'])) {
                $authenticatedAccount = $this->signInWithEmailAndPassword($request['email'], $request['password']);
            } else {
                $authenticatedAccount = $this->signInWithRefreshToken($request);
            }

            if ($authenticatedAccount == '') {
                throw new Exception('Access Denied: Either a token or username and password are required to login.', 403);
            }

            $location = '';
            
            if (isset($request['location'])) {
                $location = $request['location'];
            }

            wp_set_current_user($authenticatedAccount->id);

            $session = new Session($authenticatedAccount, $_SERVER['REMOTE_ADDR'], $location, $_SERVER['HTTP_USER_AGENT']);

            new SessionCreate($session);

            (new Cookie())->set($session);
           
            if (!is_user_logged_in()) {
                throw new Exception('You could not be logged in.', 403);
            }

            $loginResponse = [
                'successMessage' => 'You have been logged in successfully',
                'authenticatedAccount' => $authenticatedAccount,
                'statusCode' => 200
            ];

            return rest_ensure_response($loginResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
