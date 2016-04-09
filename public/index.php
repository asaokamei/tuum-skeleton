<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

session_start();
require __DIR__ . '/../vendor/autoload.php';


/**
 * configuration for AppBuilder. 
 */
$config = [
    'debug'    => true,
    'env'      => null,
    'env-file' => 'env.php',
];


/**
 * Run app
 */
$app = include __DIR__ . '/../app/app.php';
$app->run();
