<?php

namespace IIT\Illuminate\Facades;

use IIT\Illuminate\App\Http\Controllers\ApiController;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;

/**
 * Class Routing
 *
 * @package IIT\Facades
 */
class Routing
{
    private static array $instances = [];
    private string $routePath;
    private array $middleware = [];

    /**
     * @return \IIT\Facades\Routing
     */
    public static function getInstance(): Routing
    {
        $cls = static::class;
        if ( !isset(self::$instances[$cls]) ) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }


    public function init(): void
    {
        $container = new Container;

        $request = Request::capture();
        $container->instance(Request::class, $request);

        $events = new Dispatcher($container);
        $router = new Router($events, $container);

        $routeMiddleware = $this->getMiddleware();
        if ( !empty($routeMiddleware) ) {
            foreach ( $routeMiddleware as $key => $middleware ) {
                $router->aliasMiddleware($key, $middleware);
            }
        }


        require_once $this->getRoutePath();

        $router->any('{any}', function () {
            return ApiController::responseNotFound();
        })->where('any', '(.*)');

        $redirect = new Redirector(new UrlGenerator($router->getRoutes(), $request));

        if ( !empty($routeMiddleware) ) {
            $response = (new Pipeline($container))
                ->send($request)
                ->then(function ($request) use ($router) {
                    return $router->dispatch($request);
                });
        } else {
            $response = $router->dispatch($request);
        }

        $response->send();
    }

    /**
     * @return string
     */
    public function getRoutePath(): string
    {
        return $this->routePath;
    }

    /**
     * @param  string  $routePath
     *
     * @return $this
     */
    public function setRoutePath(string $routePath): Routing
    {
        $this->routePath = $routePath;

        return $this;
    }


    /**
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    /**
     * @param  array  $middleware
     *
     * @return $this
     */
    public function setMiddleware(array $middleware): Routing
    {
        $this->middleware = $middleware;

        return $this;
    }


}
