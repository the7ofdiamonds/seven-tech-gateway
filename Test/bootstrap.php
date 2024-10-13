<?php

define('WP_ENVIRONMENT_TYPE', 'testing');

require_once dirname(__DIR__, 4) . '/wp-load.php';

require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

define('SEVEN_TECH_GATEWAY', dirname(__DIR__, 1));
define('SEVEN_TECH_GATEWAY_URL', dirname(__DIR__, 1));
define('GOOGLE_SERVICE_ACCOUNT', dirname(__DIR__, 1) . '/Configuration/serviceAccount.json');