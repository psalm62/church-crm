<?php

/**
 * Configuration
 *
 */

define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

define('URL_PUBLIC_FOLDER', '');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

// $dbA='aes-256-cbc';
// $dbGlobalKey = base64_decode('mKcmU/e5OebOlzhzLkKhlg==');
// $dbGlobalIv = base64_decode('ShngnvRSS5J5d0Q9U2sDyA==');
define('DBA', 'aes-256-cbc');
define('GLOBAL_KEY', base64_decode('mKcmU/e5OebOlzhzLkKhlg=='));
define('GLOBAL_IV', base64_decode('ShngnvRSS5J5d0Q9U2sDyA=='));

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'light_auth');
define('DB_USER', 'light_auth');
define('DB_PASS', 'light_auth');
define('DB_CHARSET', 'utf8');