<?php

namespace IIT\Notify\App\Http\Controllers\Notifies;

use IIT\Illuminate\App\Http\Controllers\ApiController;
use IIT\Notify\Src\Classes\Controller\NotifyController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UnsentController
 * Use for work with unsent notifies
 *
 * @package IIT\Notify\App\Http\Controllers\Notifies
 */
class UnsentController extends ApiController
{
    public function get(Request $request): JsonResponse
    {
        $cNotify = new NotifyController();
        $cNotify->sendUnsentNotificationsToWebsocket($request->get('userId'));

        return self::response();
    }
}