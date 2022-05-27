<?php

use Bitrix\Main\Loader;
use Illuminate\Routing\Router;

Loader::includeModule('sl.content');
/** @var $router Router */

$router->prefix('content')->group(
    function () use ($router) {
        $router->get('/list', [IIT\Content\App\Http\Controllers\ContentController::class, 'list'])
            ->middleware(['content']);

        $router->get('/page', [IIT\Content\App\Http\Controllers\ContentController::class, 'get'])
            ->middleware(['content']);
    }
);