<?php
declare(strict_types=1);

use Relay\Relay;
use Zend\Diactoros\ServerRequestFactory;
use Narrowspark\HttpEmitter\SapiEmitter;
use Src\App;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;

require_once dirname(__DIR__) . '/vendor/autoload.php';



$container = App::getContainer();
$routes = App::getRoutes();
$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);
$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();

return $emitter->emit($response);