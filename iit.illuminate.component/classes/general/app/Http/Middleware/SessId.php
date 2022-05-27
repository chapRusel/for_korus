<?php

namespace IIT\Illuminate\App\Http\Middleware;

use Closure;
use IIT\Illuminate\App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class SessId
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @param  string|null               $guard
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next, string $guard = null)
    {
        if ( !check_bitrix_sessid() ) {
            return ApiController::responseUnauthorized();
        }

        return $next($request);
    }
}
