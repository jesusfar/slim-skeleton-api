<?php

namespace App\Providers;

use Slim\App;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * LoggerServiceProvider
 *
 * @category  Providers
 * @package   Providers
 * @author    Jesus Farfan <jesus.farfan@nidarbox.com>
 * @copyright Jesus Farfan
 * @license   MIT 
 * @link      https://nidarbox.com
 */
class LoggerServiceProvider implements ServiceProviderInterface
{
    /**
     * boot serviceprovider
     *
     * @param Container $container Container
     *
     * @return void
     */
    public function boot(Container $container)
    {

    }

    /**
     * register serviceprovider
     *
     * @param Application $app App object inyected
     *
     * @return void
     */
    public function register(Container $container)
    {
        $settingLoggers = $container->get('settings')['loggers'] ?? [];
        $loggers = [];

        foreach ($settingLoggers as $name => $setting) {
            $level = $setting['level'] ?? Logger::WARNING;
            $path  = $setting['path'] ?? $name . '.log';
            $loggers[$name] = $this->getLogger($name, $level, $path);
        }

        $container['loggers'] = $loggers;
    }

    private function getLogger(string $name, string $level, string $path)
    {
        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler($path), $level);

        return $logger;
    }
}
