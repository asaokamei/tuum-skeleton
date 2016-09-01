<?php
use Tuum\Builder\AppBuilder;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/app.php';

/**
 * configure and build a demo application.
 */
$builder = AppBuilder::forge(
    dirname(__DIR__) . '/app',
    dirname(__DIR__) . '/var',
    [
        'debug'    => true,
        'env'      => null,
        'env-file' => 'env.php',
    ]
);
$app = build_demo_application($builder);

session_start();
$app->run();
