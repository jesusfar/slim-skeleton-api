<?php

namespace App\Providers;

use Slim\App;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * ConfigServiceProvider
 *
 * @category  Providers
 * @package   Providers
 * @author    Jesus Farfan <jesus.farfan@nidarbox.com>
 * @copyright Jesus Farfan
 * @license   MIT 
 * @link      https://nidarbox.com
 */
class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * @var string Prefix config
     */
    private $prefix;

    /**
     * __construct
     *
     * @param string $prefix Prefix config
     *
     * @return void
     */
    public function __construct(string $prefix = 'config')
    {
        $this->prefix = $prefix;
    }

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
        $this->loadConfig($app);
    }

    private function loadConfig(Container $app)
    {

        $configLoaded = [];

        $files = glob(__DIR__ . '/../../app/config/*.{yml}', GLOB_BRACE);

        foreach ($files as $file) {
            $config = $this->parseConfig($file);

            foreach ($config as $key => $value) {
                $configLoaded[$key] = $value;
            }
        }
        $app[$this->prefix] = function ($app) use ($configLoaded) {
            return $configLoaded;
        };
    }

    private function parseConfig(string $filePath) : array
    {
        $config = [];

        try {
            $config = Yaml::parse(file_get_contents($filePath));
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }

        return $config;
    }
}
