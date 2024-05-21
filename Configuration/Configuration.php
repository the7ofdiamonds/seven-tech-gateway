<?php

namespace SEVEN_TECH\Gateway\Configuration;

use Exception;

class Configuration
{
    public function __construct()
    {
    }

    function uploadConfigFile($file)
    {
        try {
            $file_path = $file['tmp_name'];
            $mime_type = $file['type'];
            $filename = $file['name'];

            if (file_exists($file_path)) {
                $upload_path = SEVEN_TECH . "Configuration/files/";
                $file_url = SEVEN_TECH_URL . "Configuration/files/{$filename}";

                $new_file_path = $upload_path . $filename;

                move_uploaded_file($file_path, $new_file_path);

                $attachment = array(
                    'guid'           => $new_file_path,
                    'post_mime_type' => $mime_type,
                    'post_title'     => sanitize_file_name($filename),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );

                $attachment_id = wp_insert_attachment($attachment, $new_file_path);

                $attachment_data = wp_generate_attachment_metadata($attachment_id, $new_file_path);

                wp_update_attachment_metadata($attachment_id, $attachment_data);

                return $file_url;
            }
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
