<?php

namespace SEVEN_TECH\Gateway\ENV;

use SEVEN_TECH\Gateway\Upload\Upload;

class ENV
{
    public $upload_path;
    public $upload_url;

    public function __construct()
    {
        $this->upload_path = SEVEN_TECH_GATEWAY; 
        $this->upload_url = SEVEN_TECH_GATEWAY_URL;
    }

    function uploadENVFile($file)
    {
        $file['name'] = '.ENV';
        (new Upload)->uploadFile($file, $this->upload_path, $this->upload_url);
    }
}
