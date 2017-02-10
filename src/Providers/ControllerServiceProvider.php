<?php

namespace App\Providers;

use Slim\App;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * RouteServiceProvider
 *
 * @category  Providers
 * @package   Providers
 * @author    Jesus Farfan <jesus.farfan@nidarbox.com>
 * @copyright Jesus Farfan
 * @license   MIT 
 * @link      https://nidarbox.com
 */
class ControllerServiceProvider implements ServiceProviderInterface
{

    /**
     * boot serviceprovider
     *
     * @param Application $app App object inyected
     *
     * @return void
     */
    public function boot(App $app)
    {

    }

    /**
     * register serviceprovider
     *
     * @param Application $app App object inyected
     *
     * @return void
     */
    public function register(Container $app)
    {
        $this->loadRoutes($app);
    }

    private function loadRoutes(Container $app)
    {

        $services = $this->parseRouteFile();
        $controllers = [];

        foreach ($services as $serviceKey => $serviceRoutes) {
            foreach ($serviceRoutes as $controllerKey => $route) {
                $containerKey = $serviceKey . '-' . $controllerKey;
                $path = $route['path'];
                $method = strtolower($route['method']);
                $controller = explode('@', $route['controller']);
                $classController = $controller[0];
                $actionController = $controller[1];

                if (!array_key_exists($classController, $app)) {
                    if (class_exists($classController)) {
                        $app[$containerKey] = function($app) use ($classController) {
                            return new $classController();
                        };
                        $controllers[$containerKey] = [
                            'path'  => $path,
                            'method' => $method,
                            'action' => $containerKey . ':' . $actionController
                        ];
                    }
                }
            }
        }

        $app['controllers'] = $controllers;
    }

    private function parseRouteFile()
    {
        $routes = [];

        try {
            $routes = Yaml::parse(file_get_contents(__DIR__ . '/../../app/routes/routes.yml'));
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }

        return $routes;
    }
}
