<?php

namespace App\Controllers;

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

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
        return $response->withJson(['payload' => 'Welcome to Upmarlin API!']);
    }

    /**
     * helloAction
     *
     * Example action controller
     *
     * @param Request     $request Request object inyected
     * @param Application $ap      App object inyected
     *
     * @return JsonResponse
     */
    public function helloAction(Request $request, Response $response) 
    {
        $name = $request->attributes->get('name');

        return new JsonResponse(['payload' => $name]);
    }
}
