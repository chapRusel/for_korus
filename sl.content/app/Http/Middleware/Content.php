<?php

namespace IIT\Content\App\Http\Middleware;

use Closure;
use IIT\Illuminate\App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class Content
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param string|null $guard
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next, string $guard = null)
    {
        $path = $request->get('path');

        if ($path) {
            if (!is_string($path)) {
                return ApiController::responseForbidden(
                    'Параметр path должен быть строкой'
                );
            }

            return $next($request);
        } else {
            return ApiController::responseForbidden(
                'Параметр path обязателен'
            );
        }
    }
}