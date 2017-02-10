<?php

/**
 * app.php
 *
 * Bootstrap the application file
 *
 * @category  Bootstrap
 * @package   Bootstrap
 * @author    Jesus Farfan <jesus.farfan@nidarbox.com>
 * @copyright Jesus Farfan
 * @license   Propietary 
 * @link      https://nidarbox.com
 */

require_once __DIR__ . '/../../vendor/autoload.php';

// Create Application with config

$container = new \Slim\Container();
$app = new \Slim\App($container);

// Register and load ConfigServiceProvider
$container->register(new App\Providers\ConfigServiceProvider('config'));

// Register and load Controller based on routes
$container->register(new App\Providers\ControllerServiceProvider());

// Register routes
foreach ($container['controllers'] as $controller) {
    $method = $controller['method'];
    $app->$method($controller['path'], $controller['action']);
}
// Todo Error handling

return $app;
