<?php

namespace SEVEN_TECH\API;

use Exception;

use SEVEN_TECH\Post_Types\Founders\Founders as PTFounders;

use WP_REST_Request;

class Founders
{
    private $pt_founder;

    public function __construct()
    {
        $this->pt_founder = new PTFounders;
    }

    function get_founders()
    {
        try {
            $founders = $this->pt_founder->getFounders();

            return rest_ensure_response($founders);
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    function get_founder(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');

            $founder = $this->pt_founder->getFounder($slug);

            return rest_ensure_response($founder);
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    function get_founder_resume(WP_REST_Request $request)
    {
        try {
            $pageTitle = $request->get_param('slug');
            $page = get_page_by_title($pageTitle, OBJECT, 'founders');
            $custom = get_post_custom($page->ID);
            $resume_pdf_url = isset($custom['founder_resume'][0]) ? esc_url($custom['founder_resume'][0]) : '';

            return rest_ensure_response($resume_pdf_url);
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }
}
