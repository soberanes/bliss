<?php
/**
 * My Global Configuration
 * /config/autoload/module.DluPhpSettings.global.php
 *
 * You can use this file for overridding configuration values from modules, etc. 
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

define('ROOT_PATHSE', dirname(dirname(__DIR__)));
session_save_path(ROOT_PATHSE.'/data/session');
return array(
    'phpSettings'   => array(
        'display_startup_errors'        => true,
        'display_errors'                => true,
        'max_execution_time'            => 60,
        'date.timezone'                 => 'America/Mexico_City',
        'mbstring.internal_encoding'    => 'UTF-8',
    ),
);