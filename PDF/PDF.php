<?php

namespace SEVEN_TECH\PDF;

class PDF
{
    public function __construct()
    {
    }

    function upload()
    {
        // Set the path to your PDF file
$pdf_file_path = '/path/to/your/file.pdf';

// Get the upload directory
$upload_dir = wp_upload_dir();

// Create a subdirectory for your PDF file
$pdf_subdir = '/your-custom-dir/';
$upload_path = $upload_dir['basedir'] . $pdf_subdir;
$upload_url = $upload_dir['baseurl'] . $pdf_subdir;

// Check if the subdirectory exists, create it if not
if (!file_exists($upload_path)) {
    wp_mkdir_p($upload_path);
}

// Move the PDF file to the new subdirectory
$new_pdf_file_path = $upload_path . basename($pdf_file_path);
rename($pdf_file_path, $new_pdf_file_path);

// Prepare the attachment array
$attachment = array(
    'guid'           => $upload_url . basename($new_pdf_file_path),
    'post_mime_type' => 'application/pdf',
    'post_title'     => sanitize_file_name(pathinfo($new_pdf_file_path, PATHINFO_FILENAME)),
    'post_content'   => '',
    'post_status'    => 'inherit'
);

// Insert the attachment into the database
$attachment_id = wp_insert_attachment($attachment, $new_pdf_file_path);

// Generate attachment metadata
$attachment_data = wp_generate_attachment_metadata($attachment_id, $new_pdf_file_path);

// Update the attachment metadata
wp_update_attachment_metadata($attachment_id, $attachment_data);

echo 'PDF uploaded successfully!';

    }
}
