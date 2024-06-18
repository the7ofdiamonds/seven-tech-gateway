<?php

namespace SEVEN_TECH\Gateway\Token;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class Token
{

    public function __construct()
    {
    }

    function hashToken($token)
    {
        if (function_exists('hash')) {
            return hash('sha256', $token);
        } else {
            return sha1($token);
        }
    }

    function verifier($username, $pass_frag, $expiration, $token, $scheme)
    {
        $key = wp_hash($username . '|' . $pass_frag . '|' . $expiration . '|' . $token, $scheme);

        $algo = function_exists('hash') ? 'sha256' : 'sha1';
        $hash = hash_hmac($algo, $username . '|' . $expiration . '|' . $token, $key);

        return $hash;
    }

    function getAccessToken(WP_REST_Request $request)
    {
        try {
            $headers = $request->get_headers();

            if (!isset($headers['authorization'][0])) {
                throw new Exception('Authorization header could not be found in the headers of this request.', 403);
            }

            $authorization = $headers['authorization'][0];
            $accessToken = substr($authorization, 7);

            if (empty($accessToken)) {
                throw new Exception('Access Token could not be found.', 403);
            }

            return $accessToken;
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (RevokedIdToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function getRefreshToken(WP_REST_Request $request)
    {
        try {
            $headers = $request->get_headers();

            if (!isset($headers['refresh_token'])) {
                throw new Exception('A Refresh Token is required to gain permission and access.', 403);
            }

            return (string) $headers['refresh_token'][0];
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (RevokedIdToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function base64UrlDecode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $input .= str_repeat('=', $addlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    function getJWT($jwtToken)
    {
        $parts = explode('.', $jwtToken);

        if (count($parts) !== 3) {
            throw new Exception("Invalid JWT token format");
        }

        return $parts;
    }

    function getJWTHeader($jwtToken)
    {
        $header = $this->getJWT($jwtToken)[0];
        $decodedHeader = $this->base64UrlDecode($header);
        $headerJson = json_decode($decodedHeader, true);

        return $headerJson;
    }

    function getJWTBody($jwtToken)
    {
        $body = $this->getJWT($jwtToken)[1];
        $decodedBody = $this->base64UrlDecode($body);
        $bodyJson = json_decode($decodedBody, true);

        return $bodyJson;
    }

    function getJWTSignature($jwtToken)
    {
        $signature = $this->getJWT($jwtToken)[2];
        // $decodedSignature = $this->base64UrlDecode($signature);
        // $signatureJson = json_decode($decodedSignature, true);

        return $signature;
    }

    function getJWTAlgorithm($jwtToken)
    {
        $headerJson = $this->getJWTHeader($jwtToken);

        if (isset($headerJson['alg'])) {
            return $headerJson['alg'];
        } else {
            throw new Exception("Algorithm not found in JWT header");
        }
    }

    function getEmailFromToken($jwtToken)
    {
        $body = $this->getJWTBody($jwtToken);

        return $body['email'];
    }
}
