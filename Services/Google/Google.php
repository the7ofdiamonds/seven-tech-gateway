<?php

namespace SEVEN_TECH\Gateway\Services\Google;

use SEVEN_TECH\Gateway\Configuration\Configuration;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class Google
{
    public bool $serviceAccountIsValid;

    public function __construct()
    {
        try {
            $this->serviceAccountIsValid = false;

            if (!file_exists(GOOGLE_SERVICE_ACCOUNT)) {
                $this->serviceAccountIsValid = false;
                throw new Exception('Google service account file does not exist.', 400);
            }

            $jsonFileContents = file_get_contents(GOOGLE_SERVICE_ACCOUNT);

            if ($jsonFileContents === false) {
                $this->serviceAccountIsValid = false;
                throw new Exception('Unable to read Google service account file.', 400);
            }

            $decodedData = json_decode($jsonFileContents, true);

            $missingFields = [];
            $requiredFields = ['type', 'project_id', 'private_key_id', 'private_key', 'client_email', 'client_id', 'auth_uri', 'token_uri', 'auth_provider_x509_cert_url', 'client_x509_cert_url', 'universe_domain'];

            foreach ($requiredFields as $field) {
                if (!isset($decodedData[$field])) {
                    $missingFields[] = $field;
                }
            }

            if (!empty($missingFields)) {
                $this->serviceAccountIsValid = false;
                $errorMessage = 'Required fields are missing: ' . implode(', ', $missingFields);
                throw new Exception($errorMessage, 400);
            }

            if ($decodedData['type'] !== 'service_account') {
                $this->serviceAccountIsValid = false;
                throw new Exception('Type is not set to service_account.', 400);
            }

            $this->serviceAccountIsValid = true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function uploadServiceAccountFile($file){
        $file['name'] = 'serviceAccount.json';
        (new Configuration)->uploadConfigFile($file);
        $this->serviceAccountIsValid = true;
    }
}
