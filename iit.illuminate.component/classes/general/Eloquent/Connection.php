<?php

namespace IIT\Illuminate\Eloquent\Database;

use IIT\Illuminate\ModuleSettings;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Klever\Views\ViewFactory;

class Connection
{
    public static function getLocalData(): array
    {
        $arSettings = ModuleSettings::get();
        $eloquentSettings = json_decode($arSettings['eloquent'], true);

        return [
            'driver'    => $eloquentSettings['ELOQUENT_DRIVER'],
            'host'      => $eloquentSettings['ELOQUENT_HOST'],
            'database'  => $eloquentSettings['ELOQUENT_DB'],
            'username'  => $eloquentSettings['ELOQUENT_USR_NAME'],
            'password'  => $eloquentSettings['ELOQUENT_USR_PASSWORD'],
            'charset'   => $eloquentSettings['ELOQUENT_CHARSET'],
            'collation' => $eloquentSettings['ELOQUENT_COLLATION'],
            'prefix'    => $eloquentSettings['ELOQUENT_PREFIX'],
        ];
    }


    public function addConnection(): Capsule
    {
        $arConnectionData = self::getLocalData();

        $capsule = new Capsule();
        $capsule->addConnection($arConnectionData);

        $capsule->setEventDispatcher(new Dispatcher(new Container()));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        self::addPaginationConnect();

        return $capsule;
    }

    private static function addPaginationConnect(): void
    {
        LengthAwarePaginator::viewFactoryResolver(function () {
            $paths = [
                config()->get('app.settings.paths.landers'),
                config()->get('app.settings.paths.views')
            ];

            $settings = [
                'cache' => config()->get('app.settings.paths.cache.views'),
                'debug' => config()->get('app.debug') // this also auto reloads views cache if set to true
            ];
            return new ViewFactory($paths, $settings);
        });

        LengthAwarePaginator::defaultView('partials/pagination.twig');

        Paginator::currentPathResolver(function () {
            return isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '/';
        });

        Paginator::currentPageResolver(function () {
            return $_GET['page'] ?? 1;
        });
    }
}
