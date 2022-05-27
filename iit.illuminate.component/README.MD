### iit.illuminate.component

> Солянка из модулей для работы с illuminate компонентами.

### Текущий набор компонентов
- Eloquent ORM
- Illuminate Routing
- Illuminate Validation

### Порядок установки
- После установки модуля необходимо будет обновить composer в папке с модулем
```php
php ./composer.phar update
```
- Так же необходимо включить PDO
```php
Всё что нужно это заменить
/etc/php.d/20-pdo.ini.disabled

на 
/etc/php.d/20-pdo.ini

Тоже самое с 30-pdo_mysql.ini.disabled

```


### Как работать
- У модуля есть интерфейс, где можно задать подключение к БД и прочие настройки конкретного компонента. Там же и включается/выключается продакшн мод.

### Продакшн мод
> Включен по умолчанию при установке модуля. Если он включен, то исключения будут заменяться заготовленным ответом. Так же через метод который описан в Helpers можно проверять режим

### Controllers
```php
/**
 * Базовый ApiController. От него наследуются ваши контроллеры
 */
\IIT\Illuminate\App\Http\Controllers\ApiController::class;

\IIT\Illuminate\App\Http\Controllers\ApiController::response(); // Успешный ответ
\IIT\Illuminate\App\Http\Controllers\ApiController::responseForbidden(); // Нет доступа
\IIT\Illuminate\App\Http\Controllers\ApiController::responseNotFound(); // Не найдено (404)
\IIT\Illuminate\App\Http\Controllers\ApiController::responseUnauthorized(); // Не авторизирован
\IIT\Illuminate\App\Http\Controllers\ApiController::responseBadRequest();
\IIT\Illuminate\App\Http\Controllers\ApiController::responseServerError();
```

### Middleware
```php
/**
 * Заготовленный Middleware для авторизации через basic auth
 */
\IIT\Illuminate\App\Http\Middleware\BasicAuth::class;

/**
 * Заготовленный Middleware для проверки сессии
 */
\IIT\Illuminate\App\Http\Middleware\SessId::class;
```

### Models
```php
/**
 * Базовая модель. От нее наследуются ваши модели
 */
\IIT\Illuminate\App\Models\Base::class;


/**
 * Модели стандартных сущностей с базовыми связями. 
 * 
 * Если необходимо будет создавать свои связи, то наследуемся от данных моделей.
 * 
 * В моделях перегружены стандартные методы create/update/delete. 
 * Сейчас там находится стандартный функционал битры, что бы происходили корректные действия при вызове
 * методов.
 */
\IIT\Illuminate\App\Models\B24\Contact\Contact::class;
\IIT\Illuminate\App\Models\B24\Deal\Deal::class;
\IIT\Illuminate\App\Models\B24\Company\Company::class;
\IIT\Illuminate\App\Models\B24\File::class;

/**
 * Имеет scope: withSrc().
 *      Сразу возвращает объект со ссылкой на файл.
 * 
 * Для множественного свойства типа "Файл" в битре создаётся отдельная связующая таблица.
 */
\IIT\Illuminate\App\Models\B24\File::class;
```

### Repositories
```php
/**
 * Базовый репозиторий для работы. Если создаёте свои, то наследуетесь от него. 
 */
\IIT\Illuminate\App\Repositories\EloquentRepository::class;
\IIT\Illuminate\App\Repositories\EloquentRepositoryInterface::class;
```

### Services
> Сервисный слой служит для вынесения обширной (часто встечаемой) логики в отдельный класс. Который будет ответственен только за выполнение заложенной в него логики.
```php
/**
 * Базовый Service. От него наследуются ваши сервисы
 */
\IIT\Illuminate\App\Services\Service::class;

/**
 * Сервисный контейнер. Выступает "Менеджером сервисов"
 */
\IIT\Illuminate\App\Services\Container::class;
```

#### Пример
```php
<?php
use IIT\Illuminate\App\Services\Service;

/**
 * Ваш собственный сервис, который что то делает.
 * Доступны методы getRepository() и getModel()
 */
class StoreService extends Service
{
    public function make(array $request)
    {
        // some logic
    }
}
```
```php
<?php
use IIT\Illuminate\App\Http\Controllers\ApiController;
use IIT\Illuminate\App\Models\B24\Deal\Deal;
use IIT\Illuminate\App\Repositories\EloquentRepository;
use IIT\Illuminate\App\Services\Container;

class OrderController extends ApiController
{
    /**
     * В __construct инициализируете объект класса Container
     * Вызываете метод setOptions, в котором задаётся 
     * модель и репозиторий
     * 
     * hiddenFields - Опциональный параметр который исключает поля из выборки. 
     * Они участвуют в фильтрации итд, но не выводятся
     * $this->container - Доступна из ApiController 
     */
    public function __construct()
    {
        $this->container = new Container();
        $this->container->setOptions([
            'model'      => Deal::class,
            'repository' => EloquentRepository::class,
            'hiddenFields' => array_values(self::RELATION_ALIASES)
        ]);
    }

    /**
     * В нужном методе задаёте нужный вам сервис, через метод setService()
     * Метод initService() инициализует сервис и далее от этого 
     * метода, можно вызывать методы вашего сервиса, например make()
     */
    public function store(Request $request): JsonResponse
    {
        /** @var StoreService $service*/
        $service = $this->container->setService(StoreService::class)->initService();

        return self::response(
            $service->make($validated)
        );
    }
}

```



### Helpers
```php
/**
 * Проверить находится ли модуль в продовом режиме
 * Если модуль в прод режиме, то исключения заменяются на заготовленный вывод
 * так же вы сами при помощи такой проверки можете детальнее описывать ошибки, а в проде задавать только заготовки
 */
\IIT\Illuminate\ModuleSettings::isProductionMode(): bool;

/**
 * Огромный набор ларавелевских хелперов.
 */ 
 
/**
 * Отправка HTTP запросов
 */
\Illuminate\Support\Facades\Http::get('http://example.com');

/**
 * Json Response
 */
\Illuminate\Routing\ResponseFactory::json($response, $status, $headers);

/**
 * Хелпер для работы со строками 
 */
\Illuminate\Support\Str::camel();
\Illuminate\Support\Str::lower();


/**
 * И ещё вагон всего, что мне лень описывать, простите(
 */
...
```

# Eloquent orm
>Добавляет в битрикс возможность работать с БД с помощью Eloquent ORM

### Примеры использования
```php
use Bitrix\Main\Loader;

Loader::includeModule('iit.illuminate.component');

/**
 * После подключения модуля, нужно будет вызвать класс для подключения БД
 */
$obConnection = new \IIT\Illuminate\Eloquent\Database\Connection();
$obConnection->addConnection();

```
### Пример модели
```php
<?php

namespace IIT\Test\App\Models;

use IIT\Test\App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'UF_FIO'
    ];
    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany(Post::class, 'UF_AUTHOR_ID', 'ID');
    }
}

```

### Как пользоваться?
При такой реализации доступны все фишки Eloquent ORM, т.е работаем так же как и Laravel
- https://laravel.com/docs/8.x/eloquent
- https://laravel.ru/docs/v5/eloquent
- https://laravel-news.com/eloquent-tips-tricks
- https://github.com/illuminate/database
- https://prominado.ru/blog/eloquent-models-with-bitrix/


# Illuminate Routing
> Вы устали от постоянных ajax файлов, кривого Request или REST API битрикса ?
>
> Добавляет в битрикс возможность использовать Router
### Примеры использования
### api.php
- Выступает файлом маршрутов (404 маршруты обрабатываются автоматически)
```php
<?php

use Bitrix\Main\Loader;

/**
 * Подключаете модуль со своим функционалом
 */
Loader::includeModule('iit.test.router');


/** @var $router Router */


/**
 * Вариация рессурсного контроллера. 
 *  - Первый вариант просто котроллер
 *  - Второй вариант с наличием middleware
 */
$router->resource('user', \IIT\Router\UserController::class);
$router->resource('user', \IIT\Router\UserController::class)->middleware('auth');


/**
 * Просто GET маршрут
 */
$router->get('/test', function () {
    return 'hello world!';
});
```

### index.php
- Выступает файлом подключения и перенаправления
```php
<?php

const STOP_STATISTICS = true;
const NOT_CHECK_PERMISSIONS = true;
const NO_KEEP_STATISTIC = 'Y';
const NO_AGENT_STATISTIC = 'Y';
const DisableEventsCheck = true;
const BX_SECURITY_SHOW_MESSAGE = true;
const XHR_REQUEST = true;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/**
 * Подключается модуль
 */
use Bitrix\Main\Loader;
Loader::includeModule('iit.illuminate.component');

/**
 * @var $routePath 
 *      Переменная для файла маршрутов
 *                
 * @var $middleware 
 *      Переменная для задания алиасов middleware
 */
$routePath = $_SERVER['DOCUMENT_ROOT'].'/local/api/api.php';
$middleware = [
    'auth' => \App\Middleware\Authenticate::class
];

/**
 * Вызов класса инициализации роутера
 * @method setRoutePath()
 *      Задаёт ссылку на файл с маршрутом
 * 
 * @method setMiddleware()
 *      Задаёт Middleware
 */
\IIT\Illuminate\Facades\Routing::getInstance()
    ->setRoutePath($routePath)
    ->setMiddleware($middleware)
    ->init();
```
### .htaccess
- Просто редиректит
```php
RewriteEngine on
RewriteRule ^.*$ index.php [NC,L]
```

### А в чём смысл то?
- Структура контроллеров и правил выглядит теперь в точности как в ларавеле (а это удобно)
```php
<?php

namespace IIT\Router;

use IIT\Router\User;
use Illuminate\Http\Request;

class UserController
{
    public function index()
    {
        return json_encode(User::all()->toArray(), JSON_THROW_ON_ERROR);
    }

    public function store(Request $request)
    {
        $fields = $request->only([ 'UF_FIO' ]);

        return $fields;
    }

    // биндинг модели в процессе доработки.
    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $fields = $request->only([ 'UF_FIO' ]);

        return json_encode($request);
    }

    public function destroy(User $user)
    {
        //
    }

}
```
Пример middleware
```php
<?php

namespace App\Middleware;

use Closure;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        global $USER;
        if (!$USER->IsAuthorized()) {
            return 'Error Authenticate. Please <a href="/login">login</a>';
        }

        return $next($request);
    }
}
```
### Как пользоваться
- https://laravel.com/docs/8.x/routing

### В процессе доработки
- Привязка модели в контроллере из маршрута (Сейчас просто определяется объект модели, но не происходит авто поиск)
- RequestValidation (https://laravel.com/docs/8.x/validation#form-request-validation)


# Illuminate Validation
> В настройках модуля указывается как подключаться к БД. Можно задать кастомный файл для ошибок + выбрать язык.
>
> Добавляет в битрикс возможность валидировать данные как в laravel

### Пример указания кастомного пути к файлу
```php
Пример ссылки - /local/modules/iit.illuminate.component/lang
В директории lang, должны быть 2 папки en и ru. 
Внутри этих папок должен быть файл validation.php (пример можно посмотреть в /iit.illuminate.component/lang)

Итоговая структура директории будет выгдядель так:
- lang
    - en
        - validation.php
    - ru
        - validation.php
```

### Примеры использования (Вариант 1)
```php
<?php

class UserValidation
{
    public static function rules(): array
    {
        return [
            'username' => [
                'required',
                'array',
                'min:1',
                'exists:users,ID'
            ],
            'username.*' => [
                'required',
                'integer',
            ],
            'password' => [
                'required',
                'string',
            ]
        ];
    }
}
```

```php
<?php

use Bitrix\Main\Loader;
use IIT\Illuminate\Validator\ValidatorFactory;
Loader::includeModule('iit.illuminate.component');

/**
 * Вариант, при котором Request будет получаться автоматически
 */
$arRules = UserValidation::rules();
$validatorFactory = ValidatorFactory::getInstance()->setRequest()->make($arRules);


/**
 * Вариант, при котором Request нужно задать самостоятельно
 */
$arRules = UserValidation::rules();
$validatorFactory = ValidatorFactory::getInstance()->setRequest($arData)->make($arRules);

/**
 * Вариант, с использованием валидации через БД
 */
$arRules = UserValidation::rules();
$validatorFactory = ValidatorFactory::getInstance()->setRequest($arData)->make($arRules, true);

/**
 * Ошибки возвращаются автоматически, при вызове класса
 */

/**
 * Возвращаются только валидируемые данные
 */
$validatorFactory;
```

### Примеры использования (Вариант 2)
```php
<?php

use IIT\Illuminate\App\Http\Requests\ApiFormRequest;

/**
 * Создаёте класс, который наследуется от класса ApiFormRequest.
 * Прегружаете метод init в параметры которого нужно передать $request в виде массива
 * Прописываете правила валидации и вызываете parent метод.
 */
class CreateRequest extends ApiFormRequest
{
    public static function init(array $request)
    {
        $rules = [
            'title' => [
                'required'
            ]
        ];

        return parent::init($request, $rules);
    }
}
```
```php
<?php

/**
 * В использовании это выглядит так:
 *      Результат с ошибками выводится автоматически
 *      В переменной $validated хранятся провалидированные данные
 */
$validated = CreateRequest::init($request->all());
```

### Как пользоваться?
- https://laravel.com/docs/8.x/validation
