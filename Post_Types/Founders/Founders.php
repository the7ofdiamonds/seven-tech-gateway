<?php

namespace SEVEN_TECH\Post_Types\Founders;

use Exception;

class Founders
{
    public function __construct()
    {
    }

    function getFounders()
    {
        $founders = [];
        $users = get_users([
            'role__in' => [
                'founder'
            ]
        ]);

        if ($users) {
            foreach ($users as $user) {
                $user_data = get_userdata($user->ID);

                $founder = array(
                    'id' => $user_data->ID,
                    'first_name' => $user_data->first_name,
                    'last_name' => $user_data->last_name,
                    'email' => $user_data->user_email,
                    'role' => $user_data->roles,
                    'author_url' => $user_data->user_url,
                    'avatar_url' => get_avatar_url($user_data->ID, ['size' => 384])
                );

                $founders[] = $founder;
            }

            return $founders;
        } else {
            throw new Exception("No Founders at this time.", 404);
        }
    }

    function getFounder($slug)
    {
        $post_type = 'founders';
        $post = get_page_by_path($slug, OBJECT, $post_type);
        $user = get_user_by('ID', $post->post_author);

        if ($user) {
            $user_data = get_userdata($user->ID);

            $founder = array(
                'id' => $user_data->ID,
                'fullName' => $user_data->first_name . ' ' . $user_data->last_name,
                'email' => $user_data->user_email,
                'title' => $user_data->roles,
                'greeting' => get_the_author_meta('description', 1),
                'author_url' => $user_data->user_url,
                'avatar_url' => get_avatar_url($user_data->ID, ['size' => 384]),
                'skills' => $this->getFounderSkills(),
                'founderResume' => $this->getFounderResume($slug)
            );

            return $founder;
        } else {
            throw new Exception("No Founders found.", 404);
        }
    }

    function getFounderSkills()
    {
        return ['html5', 'css3-alt', 'js', 'php', 'java', 'swift', 'docker'];
    }

    function getFounderResume($pageTitle)
    {
        $outputString = str_replace('-', '', $pageTitle);
        $founderName = strtoupper($outputString);
        $resume_pdf = SEVEN_TECH . 'resume/' . $founderName . '_Resume.pdf';

        if (file_exists($resume_pdf)) {
            $resume_pdf_url = SEVEN_TECH_URL . 'resume/' . $founderName . '_Resume.pdf';

            return $resume_pdf_url;
        } else {
            throw new Exception('Resume has not been uploaded.', 404);
        }
    }
}
