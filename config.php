<?php

/**
 * The project's root folder path, like '/var/www/'.
 */
define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__)));

/**
 * The project's 'app' folder path, like '/var/www/app'.
 */
define('APP_PATH', ROOT_PATH . '/app');

/**
 * Configuration for PHP error reporting.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Configuration for database.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mvcify');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Configuration for: SITE_URL
 * Here we auto-detect your apps URL and the potential sub-folder path.
 * Works perfectly on most servers and in local development environments (like
 * WAMP, MAMP, etc.).
 *
 * SITE_PROTOCOL:
 * The site protocol. This defines the protocol part of the URL, it can be
 * 'http://' for normal HTTP and 'https://' if you have a HTTPS site or you can
 * use protocol-independent '//', which auto-recognized the protocol. If your
 * project runs with http and https, change to '//'.
 *
 * SITE_DOMAIN:
 * The site domain name.
 *
 * SITE_PATH:
 * The sub-folder path. Leave it like it is, even if you don't use a sub-folder.
 *
 * SITE_URL:
 * The final, auto-detected URL (build via the segments above). If you don't
 * want to use auto-detection, then replace this line with full URL (and
 * sub-folder) and a trailing slash.
 */
define('SITE_PROTOCOL', 'http://');
define('SITE_DOMAIN', $_SERVER['HTTP_HOST']);
define('SITE_SUB_FOLDER', trim(str_replace(DIRECTORY_SEPARATOR, '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));
define('SITE_URL', rtrim(SITE_PROTOCOL . SITE_DOMAIN . '/' . SITE_SUB_FOLDER, '/'));
