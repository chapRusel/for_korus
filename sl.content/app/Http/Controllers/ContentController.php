<?php

namespace IIT\Content\App\Http\Controllers;

use IIT\Content\App\Services\ContentService;
use IIT\Illuminate\App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ContentController
 * Using for getting pages content
 *
 * @package IIT\Content\App\Http\Controllers
 */
class ContentController extends ApiController
{
    /**
     * @param Request $request
     * @param ContentService $service
     * @return JsonResponse
     */
    public function list(Request $request, ContentService $service): JsonResponse
    {
        return self::response(
            $service->getPages($request->get('path'))
        );
    }

    /**
     * @param Request $request
     * @param ContentService $service
     * @return JsonResponse
     */
    public function get(Request $request, ContentService $service): JsonResponse
    {
        return self::response(
            $service->getContent($request->get('path'))
        );
    }
}