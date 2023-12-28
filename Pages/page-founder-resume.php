<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        $currentURL = $_SERVER['REQUEST_URI'];
        $urlPosition = explode('/', $currentURL);
        $page = get_page_by_path($urlPosition[2], OBJECT, 'founders');
        error_log(print_r($page, true));
        if ($page) {
            $founderTitle = $page->post_title;
            $resumeTitle = $founderTitle . ' Resume';
            echo $resumeTitle;
        } else {
            echo "Page not found!";
        }
        ?>
    </title>

    <?php
    $site_icon_url = get_site_icon_url();
    if ($site_icon_url) {
        echo '<link rel="icon" href="' . esc_url($site_icon_url) . '" sizes="32x32" type="image/png">';
    }
    ?>
    <style>
        main {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <style>
        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <?php
    $currentURL = $_SERVER['REQUEST_URI'];
    $urlPosition = explode('/', $currentURL);
    $outputString = str_replace('-', '', $urlPosition[2]);
    $founderName = strtoupper($outputString);
    $resume_pdf = SEVEN_TECH . 'resume/' . $founderName . '_Resume.pdf';
    $resume_pdf_url = SEVEN_TECH_URL . 'resume/' . $founderName . '_Resume.pdf';

    if (file_exists($resume_pdf)) : ?>
        <iframe id="pdfViewer" src="<?php echo $resume_pdf_url; ?>" frameborder="0"></iframe>
    <?php else : ?>
        <main>
            <h4>This resume does not exist.</h4>
        </main>
    <?php endif; ?>

</body>

</html>