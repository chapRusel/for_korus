<?php

namespace IIT\Notify\App\Http\Controllers\WebSockets;

use IIT\Illuminate\App\Http\Controllers\ApiController;
use IIT\Notify\App\WebSockets\Config;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class WebSocketController
 *
 * @package IIT\Notify\App\Http\Controllers
 */
class WebSocketController extends ApiController
{
    public function get(Request $request): JsonResponse
    {
        return self::response(
            Config::getForUser($request->get('userId'))
        );
    }
}