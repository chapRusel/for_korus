<div class="markdown-body"><h3>
        <a id="user-content-iitilluminatecomponent" class="anchor" href="#iitilluminatecomponent"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>iit.illuminate.component
    </h3>
    <blockquote>
        <p>Солянка из модулей для работы с illuminate компонентами.</p>
    </blockquote>
    <h3>
        <a id="user-content-текущий-набор-компонентов" class="anchor"
           href="#%D1%82%D0%B5%D0%BA%D1%83%D1%89%D0%B8%D0%B9-%D0%BD%D0%B0%D0%B1%D0%BE%D1%80-%D0%BA%D0%BE%D0%BC%D0%BF%D0%BE%D0%BD%D0%B5%D0%BD%D1%82%D0%BE%D0%B2"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Текущий набор компонентов
    </h3>
    <ul>
        <li>Eloquent ORM</li>
        <li>Illuminate Routing</li>
        <li>Illuminate Validation</li>
    </ul>
    <h3>
        <a id="user-content-порядок-установки" class="anchor"
           href="#%D0%BF%D0%BE%D1%80%D1%8F%D0%B4%D0%BE%D0%BA-%D1%83%D1%81%D1%82%D0%B0%D0%BD%D0%BE%D0%B2%D0%BA%D0%B8"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Порядок установки</h3>
    <ul>
        <li>После установки модуля необходимо будет обновить composer в папке с модулем</li>
    </ul>
    <div class="highlight highlight-text-html-php">
        <pre>php ./composer.phar update</pre>
    </div>
    <ul>
        <li>Так же необходимо включить PDO</li>
    </ul>
    <div class="highlight highlight-text-html-php"><pre>Всё что нужно это заменить
/etc/php.d/<span class="pl-c1">20</span>-pdo.ini.disabled

на
/etc/php.d/<span class="pl-c1">20</span>-pdo.ini

Тоже самое с <span class="pl-c1">30</span>-pdo_mysql.ini.disabled</pre>
    </div>
    <h3>
        <a id="user-content-как-работать" class="anchor"
           href="#%D0%BA%D0%B0%D0%BA-%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0%D1%82%D1%8C" aria-hidden="true"><span
                aria-hidden="true" class="octicon octicon-link"></span></a>Как работать</h3>
    <ul>
        <li>У модуля есть интерфейс, где можно задать подключение к БД и прочие настройки конкретного компонента. Там же
            и включается/выключается продакшн мод.
        </li>
    </ul>
    <h3>
        <a id="user-content-продакшн-мод" class="anchor"
           href="#%D0%BF%D1%80%D0%BE%D0%B4%D0%B0%D0%BA%D1%88%D0%BD-%D0%BC%D0%BE%D0%B4" aria-hidden="true"><span
                aria-hidden="true" class="octicon octicon-link"></span></a>Продакшн мод</h3>
    <blockquote>
        <p>Включен по умолчанию при установке модуля. Если он включен, то исключения будут заменяться заготовленным
            ответом. Так же через метод который описан в Helpers можно проверять режим</p>
    </blockquote>
    <h3>
        <a id="user-content-controllers" class="anchor" href="#controllers" aria-hidden="true"><span aria-hidden="true"
                                                                                                     class="octicon octicon-link"></span></a>Controllers
    </h3>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-c">/**</span>
<span class="pl-c"> * Базовый ApiController. От него наследуются ваши контроллеры</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Http</span>\<span
                class="pl-v">Controllers</span>\<span class="pl-v">ApiController</span>::class;

\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Http</span>\<span
                class="pl-v">Controllers</span>\<span class="pl-v">ApiController</span>::<span class="pl-en">response</span>(); <span
                class="pl-c">// Успешный ответ</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Http</span>\<span
                class="pl-v">Controllers</span>\<span class="pl-v">ApiController</span>::<span class="pl-en">responseForbidden</span>(); <span
                class="pl-c">// Нет доступа</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Http</span>\<span
                class="pl-v">Controllers</span>\<span class="pl-v">ApiController</span>::<span class="pl-en">responseNotFound</span>(); <span
                class="pl-c">// Не найдено (404)</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Http</span>\<span
                class="pl-v">Controllers</span>\<span class="pl-v">ApiController</span>::<span class="pl-en">responseUnauthorized</span>(); <span
                class="pl-c">// Не авторизирован</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Http</span>\<span
                class="pl-v">Controllers</span>\<span class="pl-v">ApiController</span>::<span class="pl-en">responseBadRequest</span>();
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Http</span>\<span
                class="pl-v">Controllers</span>\<span class="pl-v">ApiController</span>::<span class="pl-en">responseServerError</span>();</pre>
    </div>
    <h3>
        <a id="user-content-middleware" class="anchor" href="#middleware" aria-hidden="true"><span aria-hidden="true"
                                                                                                   class="octicon octicon-link"></span></a>Middleware
    </h3>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-c">/**</span>
<span class="pl-c"> * Заготовленный Middleware для авторизации через basic auth</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Http</span>\<span
                class="pl-v">Middleware</span>\<span class="pl-v">BasicAuth</span>::class;

<span class="pl-c">/**</span>
<span class="pl-c"> * Заготовленный Middleware для проверки сессии</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Http</span>\<span
                class="pl-v">Middleware</span>\<span class="pl-v">SessId</span>::class;</pre>
    </div>
    <h3>
        <a id="user-content-models" class="anchor" href="#models" aria-hidden="true"><span aria-hidden="true"
                                                                                           class="octicon octicon-link"></span></a>Models
    </h3>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-c">/**</span>
<span class="pl-c"> * Базовая модель. От нее наследуются ваши модели</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Models</span>\<span
                class="pl-v">Base</span>::class;


<span class="pl-c">/**</span>
<span class="pl-c"> * Модели стандартных сущностей с базовыми связями. </span>
<span class="pl-c"> * </span>
<span class="pl-c"> * Если необходимо будет создавать свои связи, то наследуемся от данных моделей.</span>
<span class="pl-c"> * </span>
<span class="pl-c"> * В моделях перегружены стандартные методы create/update/delete. </span>
<span class="pl-c"> * Сейчас там находится стандартный функционал битры, что бы происходили корректные действия при вызове</span>
<span class="pl-c"> * методов.</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Models</span>\<span
                class="pl-v">B24</span>\<span class="pl-v">Contact</span>\<span class="pl-v">Contact</span>::class;
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Models</span>\<span
                class="pl-v">B24</span>\<span class="pl-v">Deal</span>\<span class="pl-v">Deal</span>::class;
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Models</span>\<span
                class="pl-v">B24</span>\<span class="pl-v">Company</span>\<span class="pl-v">Company</span>::class;
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Models</span>\<span
                class="pl-v">B24</span>\<span class="pl-v">File</span>::class;

<span class="pl-c">/**</span>
<span class="pl-c"> * Имеет scope: withSrc().</span>
<span class="pl-c"> *      Сразу возвращает объект со ссылкой на файл.</span>
<span class="pl-c"> * </span>
<span class="pl-c"> * Для множественного свойства типа "Файл" в битре создаётся отдельная связующая таблица.</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Models</span>\<span
                class="pl-v">B24</span>\<span class="pl-v">File</span>::class;</pre>
    </div>
    <h3>
        <a id="user-content-repositories" class="anchor" href="#repositories" aria-hidden="true"><span
                aria-hidden="true" class="octicon octicon-link"></span></a>Repositories</h3>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-c">/**</span>
<span class="pl-c"> * Базовый репозиторий для работы. Если создаёте свои, то наследуетесь от него. </span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Repositories</span>\<span
                class="pl-v">EloquentRepository</span>::class;
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Repositories</span>\<span
                class="pl-v">EloquentRepositoryInterface</span>::class;</pre>
    </div>
    <h3>
        <a id="user-content-services" class="anchor" href="#services" aria-hidden="true"><span aria-hidden="true"
                                                                                               class="octicon octicon-link"></span></a>Services
    </h3>
    <blockquote>
        <p>Сервисный слой служит для вынесения обширной (часто встечаемой) логики в отдельный класс. Который будет
            ответственен только за выполнение заложенной в него логики.</p>
    </blockquote>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-c">/**</span>
<span class="pl-c"> * Базовый Service. От него наследуются ваши сервисы</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Services</span>\<span
                class="pl-v">Service</span>::class;

<span class="pl-c">/**</span>
<span class="pl-c"> * Сервисный контейнер. Выступает "Менеджером сервисов"</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">App</span>\<span class="pl-v">Services</span>\<span
                class="pl-v">Container</span>::class;</pre>
    </div>
    <h4>
        <a id="user-content-пример" class="anchor" href="#%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80" aria-hidden="true"><span
                aria-hidden="true" class="octicon octicon-link"></span></a>Пример</h4>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>
<span class="pl-k">use</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span
                class="pl-v">App</span>\<span class="pl-v">Services</span>\<span class="pl-v">Service</span>;

<span class="pl-c">/**</span>
<span class="pl-c"> * Ваш собственный сервис, который что то делает.</span>
<span class="pl-c"> * Доступны методы getRepository() и getModel()</span>
<span class="pl-c"> */</span>
<span class="pl-k">class</span> <span class="pl-v">StoreService</span> <span class="pl-k">extends</span> <span
                class="pl-v">Service</span>
{
    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">make</span>(<span
                class="pl-smi">array</span> <span class="pl-s1"><span class="pl-c1">$</span>request</span>)
    {
        <span class="pl-c">// some logic</span>
    }
}</pre>
    </div>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>
<span class="pl-k">use</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span
                class="pl-v">App</span>\<span class="pl-v">Http</span>\<span class="pl-v">Controllers</span>\<span
                class="pl-v">ApiController</span>;
<span class="pl-k">use</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span
                class="pl-v">App</span>\<span class="pl-v">Models</span>\<span class="pl-v">B24</span>\<span
                class="pl-v">Deal</span>\<span class="pl-v">Deal</span>;
<span class="pl-k">use</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span
                class="pl-v">App</span>\<span class="pl-v">Repositories</span>\<span
                class="pl-v">EloquentRepository</span>;
<span class="pl-k">use</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span
                class="pl-v">App</span>\<span class="pl-v">Services</span>\<span class="pl-v">Container</span>;

<span class="pl-k">class</span> <span class="pl-v">OrderController</span> <span class="pl-k">extends</span> <span
                class="pl-v">ApiController</span>
{
    <span class="pl-c">/**</span>
<span class="pl-c">     * В __construct инициализируете объект класса Container</span>
<span class="pl-c">     * Вызываете метод setOptions, в котором задаётся </span>
<span class="pl-c">     * модель и репозиторий</span>
<span class="pl-c">     * </span>
<span class="pl-c">     * hiddenFields - Опциональный параметр который исключает поля из выборки. </span>
<span class="pl-c">     * Они участвуют в фильтрации итд, но не выводятся</span>
<span class="pl-c">     * $this-&gt;container - Доступна из ApiController </span>
<span class="pl-c">     */</span>
    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">__construct</span>()
    {
        <span class="pl-s1"><span class="pl-c1">$</span><span class="pl-smi">this</span></span>-&gt;<span class="pl-c1">container</span> = <span
                class="pl-k">new</span> <span class="pl-v">Container</span>();
        <span class="pl-s1"><span class="pl-c1">$</span><span class="pl-smi">this</span></span>-&gt;<span class="pl-c1">container</span>-&gt;<span
                class="pl-en">setOptions</span>([
            <span class="pl-s">'model'</span>      =&gt; <span class="pl-v">Deal</span>::class,
            <span class="pl-s">'repository'</span> =&gt; <span class="pl-v">EloquentRepository</span>::class,
            <span class="pl-s">'hiddenFields'</span> =&gt; <span class="pl-en">array_values</span>(<span class="pl-smi">self</span>::<span
                class="pl-c1">RELATION_ALIASES</span>)
        ]);
    }

    <span class="pl-c">/**</span>
<span class="pl-c">     * В нужном методе задаёте нужный вам сервис, через метод setService()</span>
<span class="pl-c">     * Метод initService() инициализует сервис и далее от этого </span>
<span class="pl-c">     * метода, можно вызывать методы вашего сервиса, например make()</span>
<span class="pl-c">     */</span>
    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">store</span>(<span
                class="pl-smi">Request</span> <span class="pl-s1"><span class="pl-c1">$</span>request</span>): <span
                class="pl-smi">JsonResponse</span>
    {
        <span class="pl-c">/** @var StoreService $service*/</span>
        <span class="pl-s1"><span class="pl-c1">$</span>service</span> = <span class="pl-s1"><span
                    class="pl-c1">$</span><span class="pl-smi">this</span></span>-&gt;<span
                class="pl-c1">container</span>-&gt;<span class="pl-en">setService</span>(<span class="pl-v">StoreService</span>::class)-&gt;<span
                class="pl-en">initService</span>();

        <span class="pl-k">return</span> <span class="pl-smi">self</span>::<span class="pl-en">response</span>(
            <span class="pl-s1"><span class="pl-c1">$</span>service</span>-&gt;<span class="pl-en">make</span>(<span
                class="pl-s1"><span class="pl-c1">$</span>validated</span>)
        );
    }
}</pre>
    </div>
    <h3>
        <a id="user-content-helpers" class="anchor" href="#helpers" aria-hidden="true"><span aria-hidden="true"
                                                                                             class="octicon octicon-link"></span></a>Helpers
    </h3>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-c">/**</span>
<span class="pl-c"> * Проверить находится ли модуль в продовом режиме</span>
<span class="pl-c"> * Если модуль в прод режиме, то исключения заменяются на заготовленный вывод</span>
<span class="pl-c"> * так же вы сами при помощи такой проверки можете детальнее описывать ошибки, а в проде задавать только заготовки</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">ModuleSettings</span>::<span
                class="pl-en">isProductionMode</span>(): bool;

<span class="pl-c">/**</span>
<span class="pl-c"> * Огромный набор ларавелевских хелперов.</span>
<span class="pl-c"> */</span>

<span class="pl-c">/**</span>
<span class="pl-c"> * Отправка HTTP запросов</span>
<span class="pl-c"> */</span>
\<span class="pl-v">Illuminate</span>\<span class="pl-v">Support</span>\<span class="pl-v">Facades</span>\<span
                class="pl-v">Http</span>::<span class="pl-en">get</span>(<span
                class="pl-s">'http://example.com'</span>);

<span class="pl-c">/**</span>
<span class="pl-c"> * Json Response</span>
<span class="pl-c"> */</span>
\<span class="pl-v">Illuminate</span>\<span class="pl-v">Routing</span>\<span class="pl-v">ResponseFactory</span>::<span
                class="pl-en">json</span>(<span class="pl-s1"><span class="pl-c1">$</span>response</span>, <span
                class="pl-s1"><span class="pl-c1">$</span>status</span>, <span class="pl-s1"><span
                    class="pl-c1">$</span>headers</span>);

<span class="pl-c">/**</span>
<span class="pl-c"> * Хелпер для работы со строками </span>
<span class="pl-c"> */</span>
\<span class="pl-v">Illuminate</span>\<span class="pl-v">Support</span>\<span class="pl-v">Str</span>::<span
                class="pl-en">camel</span>();
\<span class="pl-v">Illuminate</span>\<span class="pl-v">Support</span>\<span class="pl-v">Str</span>::<span
                class="pl-en">lower</span>();


<span class="pl-c">/**</span>
<span class="pl-c"> * И ещё вагон всего, что мне лень описывать, простите(</span>
<span class="pl-c"> */</span>
<span class="pl-c1">.</span>.<span class="pl-c1">.</span></pre>
    </div>
    <h1>
        <a id="user-content-eloquent-orm" class="anchor" href="#eloquent-orm" aria-hidden="true"><span
                aria-hidden="true" class="octicon octicon-link"></span></a>Eloquent orm</h1>
    <blockquote>
        <p>Добавляет в битрикс возможность работать с БД с помощью Eloquent ORM</p>
    </blockquote>
    <h3>
        <a id="user-content-примеры-использования" class="anchor"
           href="#%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80%D1%8B-%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Примеры использования
    </h3>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-k">use</span> <span
                class="pl-v">Bitrix</span>\<span class="pl-v">Main</span>\<span class="pl-v">Loader</span>;

<span class="pl-v">Loader</span>::<span class="pl-en">includeModule</span>(<span
                class="pl-s">'iit.illuminate.component'</span>);

<span class="pl-c">/**</span>
<span class="pl-c"> * После подключения модуля, нужно будет вызвать класс для подключения БД</span>
<span class="pl-c"> */</span>
<span class="pl-s1"><span class="pl-c1">$</span>obConnection</span> = <span class="pl-k">new</span> \<span
                class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span
                class="pl-v">Eloquent</span>\<span class="pl-v">Database</span>\<span class="pl-v">Connection</span>();
<span class="pl-s1"><span class="pl-c1">$</span>obConnection</span>-&gt;<span
                class="pl-en">addConnection</span>();</pre>
    </div>
    <h3>
        <a id="user-content-пример-модели" class="anchor"
           href="#%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80-%D0%BC%D0%BE%D0%B4%D0%B5%D0%BB%D0%B8" aria-hidden="true"><span
                aria-hidden="true" class="octicon octicon-link"></span></a>Пример модели</h3>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>

<span class="pl-k">namespace</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Test</span>\<span
                class="pl-v">App</span>\<span class="pl-v">Models</span>;

<span class="pl-k">use</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Test</span>\<span
                class="pl-v">App</span>\<span class="pl-v">Models</span>\<span class="pl-v">Post</span>;
<span class="pl-k">use</span> <span class="pl-v">Illuminate</span>\<span class="pl-v">Database</span>\<span
                class="pl-v">Eloquent</span>\<span class="pl-v">Model</span>;

<span class="pl-k">class</span> <span class="pl-v">User</span> <span class="pl-k">extends</span> <span class="pl-v">Model</span>
{
    <span class="pl-k">protected</span> <span class="pl-c1"><span class="pl-c1">$</span>fillable</span> = [
        <span class="pl-s">'UF_FIO'</span>
    ];
    <span class="pl-k">public</span> <span class="pl-c1"><span class="pl-c1">$</span>timestamps</span> = <span
                class="pl-c1">false</span>;

    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">posts</span>()
    {
        <span class="pl-k">return</span> <span class="pl-s1"><span class="pl-c1">$</span><span
                    class="pl-smi">this</span></span>-&gt;<span class="pl-en">hasMany</span>(<span
                class="pl-v">Post</span>::class, <span class="pl-s">'UF_AUTHOR_ID'</span>, <span
                class="pl-s">'ID'</span>);
    }
}</pre>
    </div>
    <h3>
        <a id="user-content-как-пользоваться" class="anchor"
           href="#%D0%BA%D0%B0%D0%BA-%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D1%8C%D1%81%D1%8F"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Как пользоваться?</h3>
    <p>При такой реализации доступны все фишки Eloquent ORM, т.е работаем так же как и Laravel</p>
    <ul>
        <li><a href="https://laravel.com/docs/8.x/eloquent" rel="nofollow">https://laravel.com/docs/8.x/eloquent</a>
        </li>
        <li><a href="https://laravel.ru/docs/v5/eloquent" rel="nofollow">https://laravel.ru/docs/v5/eloquent</a></li>
        <li><a href="https://laravel-news.com/eloquent-tips-tricks" rel="nofollow">https://laravel-news.com/eloquent-tips-tricks</a>
        </li>
        <li><a href="https://github.com/illuminate/database">https://github.com/illuminate/database</a></li>
        <li><a href="https://prominado.ru/blog/eloquent-models-with-bitrix/" rel="nofollow">https://prominado.ru/blog/eloquent-models-with-bitrix/</a>
        </li>
    </ul>
    <h1>
        <a id="user-content-illuminate-routing" class="anchor" href="#illuminate-routing" aria-hidden="true"><span
                aria-hidden="true" class="octicon octicon-link"></span></a>Illuminate Routing</h1>
    <blockquote>
        <p>Вы устали от постоянных ajax файлов, кривого Request или REST API битрикса ?</p>
        <p>Добавляет в битрикс возможность использовать Router</p>
    </blockquote>
    <h3>
        <a id="user-content-примеры-использования-1" class="anchor"
           href="#%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80%D1%8B-%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F-1"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Примеры использования
    </h3>
    <h3>
        <a id="user-content-apiphp" class="anchor" href="#apiphp" aria-hidden="true"><span aria-hidden="true"
                                                                                           class="octicon octicon-link"></span></a>api.php
    </h3>
    <ul>
        <li>Выступает файлом маршрутов (404 маршруты обрабатываются автоматически)</li>
    </ul>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>

<span class="pl-k">use</span> <span class="pl-v">Bitrix</span>\<span class="pl-v">Main</span>\<span
                class="pl-v">Loader</span>;

<span class="pl-c">/**</span>
<span class="pl-c"> * Подключаете модуль со своим функционалом</span>
<span class="pl-c"> */</span>
<span class="pl-v">Loader</span>::<span class="pl-en">includeModule</span>(<span class="pl-s">'iit.test.router'</span>);


<span class="pl-c">/** @var $router Router */</span>


<span class="pl-c">/**</span>
<span class="pl-c"> * Вариация рессурсного контроллера. </span>
<span class="pl-c"> *  - Первый вариант просто котроллер</span>
<span class="pl-c"> *  - Второй вариант с наличием middleware</span>
<span class="pl-c"> */</span>
<span class="pl-s1"><span class="pl-c1">$</span>router</span>-&gt;<span class="pl-en">resource</span>(<span
                class="pl-s">'user'</span>, \<span class="pl-c1">IIT</span>\<span class="pl-v">Router</span>\<span
                class="pl-v">UserController</span>::class);
<span class="pl-s1"><span class="pl-c1">$</span>router</span>-&gt;<span class="pl-en">resource</span>(<span
                class="pl-s">'user'</span>, \<span class="pl-c1">IIT</span>\<span class="pl-v">Router</span>\<span
                class="pl-v">UserController</span>::class)-&gt;<span class="pl-en">middleware</span>(<span
                class="pl-s">'auth'</span>);


<span class="pl-c">/**</span>
<span class="pl-c"> * Просто GET маршрут</span>
<span class="pl-c"> */</span>
<span class="pl-s1"><span class="pl-c1">$</span>router</span>-&gt;<span class="pl-en">get</span>(<span class="pl-s">'/test'</span>, <span
                class="pl-k">function</span> () {
    <span class="pl-k">return</span> <span class="pl-s">'hello world!'</span>;
});</pre>
    </div>
    <h3>
        <a id="user-content-indexphp" class="anchor" href="#indexphp" aria-hidden="true"><span aria-hidden="true"
                                                                                               class="octicon octicon-link"></span></a>index.php
    </h3>
    <ul>
        <li>Выступает файлом подключения и перенаправления</li>
    </ul>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>

<span class="pl-k">const</span> <span class="pl-c1">STOP_STATISTICS</span> = <span class="pl-c1">true</span>;
<span class="pl-k">const</span> <span class="pl-c1">NOT_CHECK_PERMISSIONS</span> = <span class="pl-c1">true</span>;
<span class="pl-k">const</span> <span class="pl-c1">NO_KEEP_STATISTIC</span> = <span class="pl-s">'Y'</span>;
<span class="pl-k">const</span> <span class="pl-c1">NO_AGENT_STATISTIC</span> = <span class="pl-s">'Y'</span>;
<span class="pl-k">const</span> <span class="pl-v">DisableEventsCheck</span> = <span class="pl-c1">true</span>;
<span class="pl-k">const</span> <span class="pl-c1">BX_SECURITY_SHOW_MESSAGE</span> = <span class="pl-c1">true</span>;
<span class="pl-k">const</span> <span class="pl-c1">XHR_REQUEST</span> = <span class="pl-c1">true</span>;

<span class="pl-k">require_once</span>(<span class="pl-s1"><span class="pl-c1">$</span><span
                    class="pl-c1">_SERVER</span></span>[<span class="pl-s">"DOCUMENT_ROOT"</span>].<span
                class="pl-s">"/bitrix/modules/main/include/prolog_before.php"</span>);

<span class="pl-c">/**</span>
<span class="pl-c"> * Подключается модуль</span>
<span class="pl-c"> */</span>
<span class="pl-k">use</span> <span class="pl-v">Bitrix</span>\<span class="pl-v">Main</span>\<span
                class="pl-v">Loader</span>;
<span class="pl-v">Loader</span>::<span class="pl-en">includeModule</span>(<span
                class="pl-s">'iit.illuminate.component'</span>);

<span class="pl-c">/**</span>
<span class="pl-c"> * @var $routePath </span>
<span class="pl-c"> *      Переменная для файла маршрутов</span>
<span class="pl-c"> *                </span>
<span class="pl-c"> * @var $middleware </span>
<span class="pl-c"> *      Переменная для задания алиасов middleware</span>
<span class="pl-c"> */</span>
<span class="pl-s1"><span class="pl-c1">$</span>routePath</span> = <span class="pl-s1"><span class="pl-c1">$</span><span
                    class="pl-c1">_SERVER</span></span>[<span class="pl-s">'DOCUMENT_ROOT'</span>].<span
                class="pl-s">'/local/api/api.php'</span>;
<span class="pl-s1"><span class="pl-c1">$</span>middleware</span> = [
    <span class="pl-s">'auth'</span> =&gt; \<span class="pl-v">App</span>\<span class="pl-v">Middleware</span>\<span
                class="pl-v">Authenticate</span>::class
];

<span class="pl-c">/**</span>
<span class="pl-c"> * Вызов класса инициализации роутера</span>
<span class="pl-c"> * @method setRoutePath()</span>
<span class="pl-c"> *      Задаёт ссылку на файл с маршрутом</span>
<span class="pl-c"> * </span>
<span class="pl-c"> * @method setMiddleware()</span>
<span class="pl-c"> *      Задаёт Middleware</span>
<span class="pl-c"> */</span>
\<span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">Facades</span>\<span
                class="pl-v">Routing</span>::<span class="pl-en">getInstance</span>()
    -&gt;<span class="pl-en">setRoutePath</span>(<span class="pl-s1"><span class="pl-c1">$</span>routePath</span>)
    -&gt;<span class="pl-en">setMiddleware</span>(<span class="pl-s1"><span class="pl-c1">$</span>middleware</span>)
    -&gt;<span class="pl-en">init</span>();</pre>
    </div>
    <h3>
        <a id="user-content-htaccess" class="anchor" href="#htaccess" aria-hidden="true"><span aria-hidden="true"
                                                                                               class="octicon octicon-link"></span></a>.htaccess
    </h3>
    <ul>
        <li>Просто редиректит</li>
    </ul>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-v">RewriteEngine</span> on
<span class="pl-v">RewriteRule</span> ^<span class="pl-c1">.</span>*<span class="pl-s1"><span class="pl-c1">$</span> index</span>.php [<span
                class="pl-c1">NC</span>,<span class="pl-v">L</span>]</pre>
    </div>
    <h3>
        <a id="user-content-а-в-чём-смысл-то" class="anchor"
           href="#%D0%B0-%D0%B2-%D1%87%D1%91%D0%BC-%D1%81%D0%BC%D1%8B%D1%81%D0%BB-%D1%82%D0%BE" aria-hidden="true"><span
                aria-hidden="true" class="octicon octicon-link"></span></a>А в чём смысл то?</h3>
    <ul>
        <li>Структура контроллеров и правил выглядит теперь в точности как в ларавеле (а это удобно)</li>
    </ul>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>

<span class="pl-k">namespace</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Router</span>;

<span class="pl-k">use</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Router</span>\<span
                class="pl-v">User</span>;
<span class="pl-k">use</span> <span class="pl-v">Illuminate</span>\<span class="pl-v">Http</span>\<span class="pl-v">Request</span>;

<span class="pl-k">class</span> <span class="pl-v">UserController</span>
{
    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">index</span>()
    {
        <span class="pl-k">return</span> <span class="pl-en">json_encode</span>(<span class="pl-v">User</span>::<span
                class="pl-en">all</span>()-&gt;<span class="pl-en">toArray</span>(), <span class="pl-c1">JSON_THROW_ON_ERROR</span>);
    }

    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">store</span>(<span
                class="pl-smi">Request</span> <span class="pl-s1"><span class="pl-c1">$</span>request</span>)
    {
        <span class="pl-s1"><span class="pl-c1">$</span>fields</span> = <span class="pl-s1"><span class="pl-c1">$</span>request</span>-&gt;<span
                class="pl-en">only</span>([ <span class="pl-s">'UF_FIO'</span> ]);

        <span class="pl-k">return</span> <span class="pl-s1"><span class="pl-c1">$</span>fields</span>;
    }

    <span class="pl-c">// биндинг модели в процессе доработки.</span>
    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">show</span>(<span
                class="pl-smi">User</span> <span class="pl-s1"><span class="pl-c1">$</span>user</span>)
    {
        <span class="pl-k">return</span> <span class="pl-s1"><span class="pl-c1">$</span>user</span>;
    }

    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">update</span>(<span
                class="pl-smi">Request</span> <span class="pl-s1"><span class="pl-c1">$</span>request</span>, <span
                class="pl-smi">User</span> <span class="pl-s1"><span class="pl-c1">$</span>user</span>)
    {
        <span class="pl-s1"><span class="pl-c1">$</span>fields</span> = <span class="pl-s1"><span class="pl-c1">$</span>request</span>-&gt;<span
                class="pl-en">only</span>([ <span class="pl-s">'UF_FIO'</span> ]);

        <span class="pl-k">return</span> <span class="pl-en">json_encode</span>(<span class="pl-s1"><span class="pl-c1">$</span>request</span>);
    }

    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">destroy</span>(<span
                class="pl-smi">User</span> <span class="pl-s1"><span class="pl-c1">$</span>user</span>)
    {
        <span class="pl-c">//</span>
    }

}</pre>
    </div>
    <p>Пример middleware</p>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>

<span class="pl-k">namespace</span> <span class="pl-v">App</span>\<span class="pl-v">Middleware</span>;

<span class="pl-k">use</span> <span class="pl-v">Closure</span>;

<span class="pl-k">class</span> <span class="pl-v">Authenticate</span>
{
    <span class="pl-c">/**</span>
<span class="pl-c">     * Handle an incoming request.</span>
<span class="pl-c">     *</span>
<span class="pl-c">     * @param  \Illuminate\Http\Request  $request</span>
<span class="pl-c">     * @param  \Closure  $next</span>
<span class="pl-c">     * @param  string|null  $guard</span>
<span class="pl-c">     * @return mixed</span>
<span class="pl-c">     */</span>
    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">handle</span>(<span
                class="pl-s1"><span class="pl-c1">$</span>request</span>, <span class="pl-smi">Closure</span> <span
                class="pl-s1"><span class="pl-c1">$</span>next</span>, <span class="pl-s1"><span
                    class="pl-c1">$</span>guard</span> = <span class="pl-c1">null</span>)
    {
        <span class="pl-k">global</span> <span class="pl-s1"><span class="pl-c1">$</span><span class="pl-c1">USER</span></span>;
        <span class="pl-k">if</span> (!<span class="pl-s1"><span class="pl-c1">$</span><span
                    class="pl-c1">USER</span></span>-&gt;<span class="pl-en">IsAuthorized</span>()) {
            <span class="pl-k">return</span> <span class="pl-s">'Error Authenticate. Please &lt;a href="/login"&gt;login&lt;/a&gt;'</span>;
        }

        <span class="pl-k">return</span> <span class="pl-s1"><span class="pl-c1">$</span>next</span>(<span
                class="pl-s1"><span class="pl-c1">$</span>request</span>);
    }
}</pre>
    </div>
    <h3>
        <a id="user-content-как-пользоваться-1" class="anchor"
           href="#%D0%BA%D0%B0%D0%BA-%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D1%8C%D1%81%D1%8F-1"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Как пользоваться</h3>
    <ul>
        <li><a href="https://laravel.com/docs/8.x/routing" rel="nofollow">https://laravel.com/docs/8.x/routing</a></li>
    </ul>
    <h3>
        <a id="user-content-в-процессе-доработки" class="anchor"
           href="#%D0%B2-%D0%BF%D1%80%D0%BE%D1%86%D0%B5%D1%81%D1%81%D0%B5-%D0%B4%D0%BE%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%BA%D0%B8"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>В процессе доработки</h3>
    <ul>
        <li>Привязка модели в контроллере из маршрута (Сейчас просто определяется объект модели, но не происходит авто
            поиск)
        </li>
        <li>RequestValidation (<a href="https://laravel.com/docs/8.x/validation#form-request-validation" rel="nofollow">https://laravel.com/docs/8.x/validation#form-request-validation</a>)
        </li>
    </ul>
    <h1>
        <a id="user-content-illuminate-validation" class="anchor" href="#illuminate-validation" aria-hidden="true"><span
                aria-hidden="true" class="octicon octicon-link"></span></a>Illuminate Validation</h1>
    <blockquote>
        <p>В настройках модуля указывается как подключаться к БД. Можно задать кастомный файл для ошибок + выбрать
            язык.</p>
        <p>Добавляет в битрикс возможность валидировать данные как в laravel</p>
    </blockquote>
    <h3>
        <a id="user-content-пример-указания-кастомного-пути-к-файлу" class="anchor"
           href="#%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80-%D1%83%D0%BA%D0%B0%D0%B7%D0%B0%D0%BD%D0%B8%D1%8F-%D0%BA%D0%B0%D1%81%D1%82%D0%BE%D0%BC%D0%BD%D0%BE%D0%B3%D0%BE-%D0%BF%D1%83%D1%82%D0%B8-%D0%BA-%D1%84%D0%B0%D0%B9%D0%BB%D1%83"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Пример указания
        кастомного пути к файлу</h3>
    <div class="highlight highlight-text-html-php"><pre>Пример ссылки - /local/modules/iit.illuminate.component/lang
В директории lang, должны быть <span class="pl-c1">2</span> папки en и ru.
Внутри этих папок должен быть файл validation.php (пример можно посмотреть в /iit.illuminate.component/lang)

Итоговая структура директории будет выгдядель так:
- lang
    - en
        - validation.php
    - ru
        - validation.php</pre>
    </div>
    <h3>
        <a id="user-content-примеры-использования-вариант-1" class="anchor"
           href="#%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80%D1%8B-%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F-%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82-1"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Примеры использования
        (Вариант 1)</h3>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>

<span class="pl-k">class</span> <span class="pl-v">UserValidation</span>
{
    <span class="pl-k">public</span> <span class="pl-k">static</span> <span class="pl-k">function</span> <span
                class="pl-en">rules</span>(): <span class="pl-smi">array</span>
    {
        <span class="pl-k">return</span> [
            <span class="pl-s">'username'</span> =&gt; [
                <span class="pl-s">'required'</span>,
                <span class="pl-s">'array'</span>,
                <span class="pl-s">'min:1'</span>,
                <span class="pl-s">'exists:users,ID'</span>
            ],
            <span class="pl-s">'username.*'</span> =&gt; [
                <span class="pl-s">'required'</span>,
                <span class="pl-s">'integer'</span>,
            ],
            <span class="pl-s">'password'</span> =&gt; [
                <span class="pl-s">'required'</span>,
                <span class="pl-s">'string'</span>,
            ]
        ];
    }
}</pre>
    </div>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>

<span class="pl-k">use</span> <span class="pl-v">Bitrix</span>\<span class="pl-v">Main</span>\<span
                class="pl-v">Loader</span>;
<span class="pl-k">use</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span class="pl-v">Validator</span>\<span
                class="pl-v">ValidatorFactory</span>;
<span class="pl-v">Loader</span>::<span class="pl-en">includeModule</span>(<span
                class="pl-s">'iit.illuminate.component'</span>);

<span class="pl-c">/**</span>
<span class="pl-c"> * Вариант, при котором Request будет получаться автоматически</span>
<span class="pl-c"> */</span>
<span class="pl-s1"><span class="pl-c1">$</span>arRules</span> = <span class="pl-v">UserValidation</span>::<span
                class="pl-en">rules</span>();
<span class="pl-s1"><span class="pl-c1">$</span>validatorFactory</span> = <span
                class="pl-v">ValidatorFactory</span>::<span class="pl-en">getInstance</span>()-&gt;<span
                class="pl-en">setRequest</span>()-&gt;<span class="pl-en">make</span>(<span class="pl-s1"><span
                    class="pl-c1">$</span>arRules</span>);


<span class="pl-c">/**</span>
<span class="pl-c"> * Вариант, при котором Request нужно задать самостоятельно</span>
<span class="pl-c"> */</span>
<span class="pl-s1"><span class="pl-c1">$</span>arRules</span> = <span class="pl-v">UserValidation</span>::<span
                class="pl-en">rules</span>();
<span class="pl-s1"><span class="pl-c1">$</span>validatorFactory</span> = <span
                class="pl-v">ValidatorFactory</span>::<span class="pl-en">getInstance</span>()-&gt;<span
                class="pl-en">setRequest</span>(<span class="pl-s1"><span
                    class="pl-c1">$</span>arData</span>)-&gt;<span class="pl-en">make</span>(<span
                class="pl-s1"><span class="pl-c1">$</span>arRules</span>);

<span class="pl-c">/**</span>
<span class="pl-c"> * Вариант, с использованием валидации через БД</span>
<span class="pl-c"> */</span>
<span class="pl-s1"><span class="pl-c1">$</span>arRules</span> = <span class="pl-v">UserValidation</span>::<span
                class="pl-en">rules</span>();
<span class="pl-s1"><span class="pl-c1">$</span>validatorFactory</span> = <span
                class="pl-v">ValidatorFactory</span>::<span class="pl-en">getInstance</span>()-&gt;<span
                class="pl-en">setRequest</span>(<span class="pl-s1"><span
                    class="pl-c1">$</span>arData</span>)-&gt;<span class="pl-en">make</span>(<span
                class="pl-s1"><span class="pl-c1">$</span>arRules</span>, <span class="pl-c1">true</span>);

<span class="pl-c">/**</span>
<span class="pl-c"> * Ошибки возвращаются автоматически, при вызове класса</span>
<span class="pl-c"> */</span>

<span class="pl-c">/**</span>
<span class="pl-c"> * Возвращаются только валидируемые данные</span>
<span class="pl-c"> */</span>
<span class="pl-s1"><span class="pl-c1">$</span>validatorFactory</span>;</pre>
    </div>
    <h3>
        <a id="user-content-примеры-использования-вариант-2" class="anchor"
           href="#%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80%D1%8B-%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F-%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82-2"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Примеры использования
        (Вариант 2)</h3>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>

<span class="pl-k">use</span> <span class="pl-c1">IIT</span>\<span class="pl-v">Illuminate</span>\<span
                class="pl-v">App</span>\<span class="pl-v">Http</span>\<span class="pl-v">Requests</span>\<span
                class="pl-v">ApiFormRequest</span>;

<span class="pl-c">/**</span>
<span class="pl-c"> * Создаёте класс, который наследуется от класса ApiFormRequest.</span>
<span class="pl-c"> * Прегружаете метод init в параметры которого нужно передать $request в виде массива</span>
<span class="pl-c"> * Прописываете правила валидации и вызываете parent метод.</span>
<span class="pl-c"> */</span>
<span class="pl-k">class</span> <span class="pl-v">CreateRequest</span> <span class="pl-k">extends</span> <span
                class="pl-v">ApiFormRequest</span>
{
    <span class="pl-k">public</span> <span class="pl-k">static</span> <span class="pl-k">function</span> <span
                class="pl-en">init</span>(<span class="pl-smi">array</span> <span class="pl-s1"><span class="pl-c1">$</span>request</span>)
    {
        <span class="pl-s1"><span class="pl-c1">$</span>rules</span> = [
            <span class="pl-s">'title'</span> =&gt; [
                <span class="pl-s">'required'</span>
            ]
        ];

        <span class="pl-k">return</span> <span class="pl-smi">parent</span>::<span class="pl-en">init</span>(<span
                class="pl-s1"><span class="pl-c1">$</span>request</span>, <span class="pl-s1"><span
                    class="pl-c1">$</span>rules</span>);
    }
}</pre>
    </div>
    <div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>

<span class="pl-c">/**</span>
<span class="pl-c"> * В использовании это выглядит так:</span>
<span class="pl-c"> *      Результат с ошибками выводится автоматически</span>
<span class="pl-c"> *      В переменной $validated хранятся провалидированные данные</span>
<span class="pl-c"> */</span>
<span class="pl-s1"><span class="pl-c1">$</span>validated</span> = <span class="pl-v">CreateRequest</span>::<span
                class="pl-en">init</span>(<span class="pl-s1"><span class="pl-c1">$</span>request</span>-&gt;<span
                class="pl-en">all</span>());</pre>
    </div>
    <h3>
        <a id="user-content-как-пользоваться-2" class="anchor"
           href="#%D0%BA%D0%B0%D0%BA-%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D1%8C%D1%81%D1%8F-2"
           aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Как пользоваться?</h3>
    <ul>
        <li><a href="https://laravel.com/docs/8.x/validation" rel="nofollow">https://laravel.com/docs/8.x/validation</a>
        </li>
    </ul>
</div>
