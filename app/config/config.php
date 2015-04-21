<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/17/15
 * Time: 1:08 PM
 */

define('DEVELOPMENT_ENV', true);
define('PDO_ERR_MODE', PDO::ERRMODE_EXCEPTION);

define('DB_ENGINE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'gistweb');

define('DEFAULT_ACTIVITY_LOG_FILE', 'activity-log.txt');