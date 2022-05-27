<?php

use Bitrix\Main\Loader;
use Illuminate\Routing\Router;

Loader::includeModule('sl.notify');
/** @var $router Router */

$router->prefix('notify')->group(
    function () use ($router) {
        $router->prefix('websocket')->group(
            function () use ($router) {
                $router->get('/', [\IIT\Notify\App\Http\Controllers\WebSockets\WebSocketController::class, 'get']);
            }
        );
        $router->prefix('unsent')->group(
            function () use ($router) {
                $router->get('/', [\IIT\Notify\App\Http\Controllers\Notifies\UnsentController::class, 'get']);
            }
        );
    }
);