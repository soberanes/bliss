<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=hopper_catalogourrea;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'session'         => array(
        'config'     => array(
            'class'   => 'Zend\Session\Config\SessionConfig',
            'options' => array(
                'name'                => 'otwebsoft',
                'save_path'           => __DIR__ . '/../../data/session',
                'use_cookies'         => true,
                'cookie_lifetime'     => 0,
                'cookie_httponly'     => true,
                'cookie_secure'       => false,
                'gc_maxlifetime'      => 3600,
                'remember_me_seconds' => 1800
            )
        ),
        'storage'    => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => array(
            array(
                'Zend\Session\Validator\RemoteAddr',
                'Zend\Session\Validator\HttpUserAgent'
            )
        )
    ),
    'static_salt' => 'aFGQ475SDsdfsaf2342',
);
