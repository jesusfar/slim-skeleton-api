<?php

namespace App\Controllers;

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Pimple\Container;

/**
 * IndexController
 *
 * @category  Controllers
 * @package   Controllers
 * @author    Jesus Farfan <jesus.farfan@nidarbox.com>
 * @copyright Jesus Farfan
 * @license   MIT 
 * @link      https://nidarbox.com
 */
class IndexController extends Controller
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container; 
    }

    /**
     * IndexAction
     *
     * @param Request     $request Request object inyected
     * @param Application $ap      App object inyected
     *
     * @return JsonResponse
     */
    public function indexAction(Request $request, Response $response)
    {
        $this->container->get('loggers')['app']->info('Welcome!!');
        return $response->withJson(['payload' => 'Welcome to Upmarlin API!']);
    }
}
