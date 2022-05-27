<?php

namespace IIT\Illuminate\App\Http\Middleware;

use Closure;
use IIT\Illuminate\App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class BasicAuth
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
        global $USER;
        $headers = $request->server->getHeaders();
        $userLogin = $headers['PHP_AUTH_USER'];
        $userPassword = $headers['PHP_AUTH_PW'];

        $authResult = $USER->Login($userLogin, $userPassword);
        if ( $authResult['TYPE'] === 'ERROR' ) {
            return ApiController::responseUnauthorized();
        }

        return $next($request);
    }
}
