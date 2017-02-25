<?php
/**
 * Created by PhpStorm.
 * User: Marthijn
 * Date: 14-1-2017
 * Time: 16:47
 */

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'mysql1090int.cp.hostnet.nl',
        'username' => 'u272988_root',
        'password' => 'Sopwith123',
        'db' => 'db272988_loginsystem'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

spl_autoload_register(function($class) {
    require_once '../classes/' . $class . '.php';
});

require_once '../functions/sanitize.php';