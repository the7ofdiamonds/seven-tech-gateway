<?php

namespace SEVEN_TECH\Gateway\Configuration;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_Error;

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

                $file_moved = move_uploaded_file($file_path, $new_file_path);

                if (!$file_moved) {
                    throw new Exception('Filename is not valid.', 400);
                }

                $attachment = array(
                    'guid'           => $new_file_path,
                    'post_mime_type' => $mime_type,
                    'post_title'     => sanitize_file_name($filename),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );

                $attachment_id = wp_insert_attachment($attachment, $new_file_path);

                $attachment_data = wp_generate_attachment_metadata($attachment_id, $new_file_path);

                $updated_attachment = wp_update_attachment_metadata($attachment_id, $attachment_data);

                if (!$updated_attachment) {
                    throw new Exception('There was an error updating atachment metadata.', 400);
                }

                return $file_url;
            }
        } catch (WP_Error $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
