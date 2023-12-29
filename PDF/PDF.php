<?php

namespace SEVEN_TECH\PDF;

class PDF
{
    public function __construct()
    {
    }

    function upload($pdf_subdir, $file_path, $filename)
    {
        if (file_exists($file_path)) {
            $upload_dir = wp_upload_dir();
            $upload_path = $upload_dir['basedir'] . $pdf_subdir;
            $pdf_file_url = $upload_dir['baseurl'] . $pdf_subdir . $filename;
            
            if (!file_exists($upload_path)) {
                wp_mkdir_p($upload_path);
            }

            $new_pdf_file_path = $upload_path . $filename;

            move_uploaded_file($file_path, $new_pdf_file_path);

            $attachment = array(
                'guid'           => $new_pdf_file_path,
                'post_mime_type' => 'application/pdf',
                'post_title'     => sanitize_file_name($filename),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );

            $attachment_id = wp_insert_attachment($attachment, $new_pdf_file_path);

            $attachment_data = wp_generate_attachment_metadata($attachment_id, $new_pdf_file_path);

            wp_update_attachment_metadata($attachment_id, $attachment_data);


            return $pdf_file_url;
        }
    }
}
