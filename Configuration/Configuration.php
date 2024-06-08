<?php

namespace SEVEN_TECH\Gateway\Configuration;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Upload\Upload;

use Exception;

use WP_Error;

class Configuration
{
    private $upload_path;
    private $upload_url;

    public function __construct()
    {
        $dir = "Configuration/files/";
        $this->upload_path = SEVEN_TECH_GATEWAY . $dir;
        $this->upload_url = SEVEN_TECH_GATEWAY_URL . $dir;
    }

    function uploadConfigFile($file)
    {
        try {
            $file_url = (new Upload)->uploadFile($file, $this->upload_path, $this->upload_url);

            return $file_url;
        } catch (WP_Error $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
