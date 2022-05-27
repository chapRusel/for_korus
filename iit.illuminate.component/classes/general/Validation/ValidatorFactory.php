<?php

namespace IIT\Illuminate\Validator;

use IIT\Illuminate\Eloquent\Database\Connection;
use IIT\Illuminate\ModuleSettings;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Validation\Factory;
use Symfony\Component\HttpFoundation\Request;

class ValidatorFactory
{
    private $arRequest = [];
    private $obTranslator;
    private $obFactory;
    private $moduleSettings;

    private function __construct()
    {
        $this->moduleSettings = ModuleSettings::get();

        foreach ($this->moduleSettings as $key => $moduleSetting) {
            $this->moduleSettings[$key] = json_decode($moduleSetting, true);
        }

        $this->setTranslator();
        $this->setFactory();
    }

    private static $instances = [];


    public static function getInstance(): ValidatorFactory
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }


    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->arRequest;
    }

    /**
     * @param  array  $arRequest
     *
     * @return $this
     */
    public function setRequest(array $arRequest = []): ValidatorFactory
    {
        $obRequest = Request::createFromGlobals();
        $this->arRequest = $arRequest ?: $obRequest->request->all();

        return $this;
    }


    /**
     * @return mixed
     */
    public function getTranslator()
    {
        return $this->obTranslator;
    }

    private function setTranslator(): void
    {
        $useRu = $this->moduleSettings['validation']['VALIDATION_LANG'];
        $customDir = $this->moduleSettings['validation']['VALIDATION_LANG_FILE_PATH'];

        $dir = !empty($customDir) ? $_SERVER['DOCUMENT_ROOT'].$customDir : $_SERVER['DOCUMENT_ROOT'].'/local/modules/iit.illuminate.component/lang';

        $filesystem = new Filesystem();
        $loader = new FileLoader(
            $filesystem, $dir
        );
        $loader->addNamespace('lang', $dir);
        if ($useRu === 'Y') {
            $loader->load($lang = 'ru', $group = 'validation', $namespace = 'lang');
        } else {
            $loader->load($lang = 'en', $group = 'validation', $namespace = 'lang');
        }


        $this->obTranslator = new Translator($loader, 'ru');
    }


    /**
     * @return mixed
     */
    public function getFactory()
    {
        return $this->obFactory;
    }

    private function setFactory(): void
    {
        $this->obFactory = new Factory($this->getTranslator());
    }


    private function setConnectToDataBase(): void
    {
        $arSettings = $this->moduleSettings;
        $capsule = new Capsule();

        if ($arSettings['validation']['VALIDATION_DB_SETTINGS'] === 'Y') {
            $connectionData = Connection::getLocalData();
        } else {
            $connectionData = [
                'driver'    => $arSettings['validation']['ELOQUENT_ALT_DRIVER'],
                'host'      => $arSettings['validation']['ELOQUENT_ALT_HOST'],
                'database'  => $arSettings['validation']['ELOQUENT_ALT_DB'],
                'username'  => $arSettings['validation']['ELOQUENT_ALT_NAME'],
                'password'  => $arSettings['validation']['ELOQUENT_ALT_PASSWORD'],
                'charset'   => $arSettings['validation']['ELOQUENT_ALT_CHARSET'],
                'collation' => $arSettings['validation']['ELOQUENT_ALT_COLLATION'],
                'prefix'    => $arSettings['validation']['ELOQUENT_ALT_PREFIX'],
            ];
        }

        $capsule->addConnection($connectionData);
        $presence = new DatabasePresenceVerifier($capsule->getDatabaseManager());
        $this->getFactory()->setPresenceVerifier($presence);
    }


    /**
     * @param  array  $arRules
     * @param  bool   $hasExist
     *
     * @return array|mixed
     * @throws \JsonException
     */
    public function make(array $arRules, bool $hasExist = false): ?array
    {
        if ($hasExist) {
            $this->setConnectToDataBase();
        }

        $obValidator = $this->getFactory()->make(
            $this->getRequest(),
            $arRules
        );

        if ($obValidator->fails()) {
            $obErrors = $obValidator->messages();

            $arErrors = $obErrors->messages();
        }

        if (!empty($arErrors)) {
            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            header('Content-Type: application/json');
            http_response_code(422);
            die(
            json_encode(
                [
                    'result' => false,
                    'error'  => $arErrors
                ],
                JSON_THROW_ON_ERROR
            )
            );
        }

        return $obValidator->validated();
    }
}
