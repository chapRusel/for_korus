<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\ModuleManager;
use IIT\Illuminate\Handlers\ErrorHandler;

if (file_exists($_SERVER['DOCUMENT_ROOT'].'/local/modules/iit.illuminate.component/vendor/autoload.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/local/modules/iit.illuminate.component/vendor/autoload.php';
}
require_once $_SERVER['DOCUMENT_ROOT'].'/local/modules/iit.illuminate.component/classes/general/Orm/SettingsTable.php';

/**
 * Class iit_illuminate_routing
 */
class iit_illuminate_component extends CModule
{
    /**
     * @var \Bitrix\Main\EventManager
     */
    protected $eventManager;

    /**
     * Class iit_illuminate_routing __construct
     */
    public function __construct()
    {
        $arModuleVersion = [];

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        $this->PATH = $path;
        include($path."/version.php");
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_ID = 'iit.illuminate.component';
        $this->MODULE_NAME = 'Модуль для работы с illuminate компонентами';
        $this->MODULE_DESCRIPTION = 'Текущий список компонентов в модуле: illuminate routing, illuminate validation, eloquent.orm';
        $this->PARTNER_NAME = 'IIT Company';
        $this->PARTNER_URI = 'https://iit.company';
        $this->eventManager = EventManager::getInstance();
    }


    /**
     * @return bool
     * @throws \Exception
     */
    public function DoInstall(): bool
    {
        global $APPLICATION;

        system(
            'cd .. && cd .. && cd local/modules/iit.illuminate.component  && php ./composer.phar update'
        );
        if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/local/modules/iit.illuminate.component/vendor')) {
            $APPLICATION->ThrowException(
                'При установке composer произошла ошибка. <br><br>
                Выполните действие "php ./composer.phar update" в папке модуля через консоль. <br>
                После установки composer продолжите установку модуля.
                '
            );
            return false;
        }

        if (PHP_VERSION_ID < 70400) {
            $APPLICATION->ThrowException('Версия PHP должна быть >= 7.4');
            return false;
        }

        if (extension_loaded('pdo') !== true && extension_loaded('pdo_mysql') !== true) {
            $APPLICATION->ThrowException('На сервере не включено 20-pdo.ini и 30-pdo_mysql.ini');
            return false;
        }

        if (extension_loaded('pdo') !== true) {
            $APPLICATION->ThrowException('На сервере не включено 20-pdo.ini');
            return false;
        }

        if (extension_loaded('pdo_mysql') !== true) {
            $APPLICATION->ThrowException('На сервере не включено 30-pdo_mysql.ini');
            return false;
        }

        if (extension_loaded('phar') !== true) {
            $APPLICATION->ThrowException('На сервере не включено 20-phar.ini');
            return false;
        }

        if (extension_loaded('curl') !== true) {
            $APPLICATION->ThrowException('На сервере не включено 20-curl.ini');
            return false;
        }


        $this->createTable();
        $this->seeds();
        $this->InstallEvents();

        ModuleManager::registerModule($this->MODULE_ID);
        return true;
    }


    /**
     * @return bool
     */
    public function DoUninstall(): bool
    {
        if (is_dir($_SERVER['DOCUMENT_ROOT'].'/local/modules/iit.illuminate.component/vendor')) {
            system(
                'cd .. && cd .. && cd local/modules/iit.illuminate.component  && rm -rf vendor/'
            );
        }
        ModuleManager::unRegisterModule($this->MODULE_ID);
        global $DB;
        $table = $DB->Query(
            "SHOW TABLES LIKE 'illuminate_component_settings'"
        );
        if ($table->Fetch() !== false) {
            $DB->Query(
                "DROP TABLE illuminate_component_settings"
            );
        }
        $this->DeleteEvents();

        return true;
    }


    private function createTable()
    {
        global $DB;
        $table = $DB->Query(
            "SHOW TABLES LIKE 'illuminate_component_settings'"
        );

        if (!$table->Fetch()) {
            $DB->Query(
                "CREATE TABLE `illuminate_component_settings` ( `id` INT NOT NULL AUTO_INCREMENT , `eloquent` VARCHAR(5000) NOT NULL ,  `validation` VARCHAR(5000) NOT NULL ,`operating_mode` VARCHAR(5000) NOT NULL,  PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;  "
            );
        }
    }

    /**
     * @throws \JsonException
     * @throws \Exception
     */
    private function seeds()
    {
        $fields = [
            'eloquent'       => json_encode($this->getDataBaseConnect(), JSON_THROW_ON_ERROR),
            'validation'     => json_encode($this->getValidation(), JSON_THROW_ON_ERROR),
            'operating_mode' => json_encode($this->getOperatingMode(), JSON_THROW_ON_ERROR),
        ];
        \IIT\Illuminate\Component\SettingsTable::add(
            $fields
        );
    }

    private function getDataBaseConnect(): array
    {
        $arConnectionData = include $_SERVER['DOCUMENT_ROOT'].'/bitrix/.settings.php';
        $host = $arConnectionData['connections']['value']['default']['host'];

        return [
            'ELOQUENT_DRIVER'       => 'mysql',
            'ELOQUENT_HOST'         => $host === 'localhost' ? '127.0.0.1' : $host,
            'ELOQUENT_DB'           => $arConnectionData['connections']['value']['default']['database'],
            'ELOQUENT_USR_NAME'     => $arConnectionData['connections']['value']['default']['login'],
            'ELOQUENT_USR_PASSWORD' => $arConnectionData['connections']['value']['default']['password'],
            'ELOQUENT_CHARSET'      => 'utf8',
            'ELOQUENT_COLLATION'    => 'utf8_unicode_ci',
            'ELOQUENT_PREFIX'       => '',
        ];
    }

    private function getOperatingMode(): array
    {
        return [
            'OPERATING_MODE_PRODUCTION' => 'Y'
        ];
    }

    private function getValidation()
    {
        return [
            'VALIDATION_DB_SETTINGS'    => 'Y',
            'VALIDATION_LANG_FILE_PATH' => '/local/modules/iit.illuminate.component/lang',
            'VALIDATION_LANG'           => 'Y',
        ];
    }


    public function InstallEvents()
    {
        $this->eventManager->registerEventHandlerCompatible(
            'main',
            'OnProlog',
            $this->MODULE_ID,
            ErrorHandler::class,
            'catch'
        );
    }


    public function DeleteEvents()
    {
        $this->eventManager->unRegisterEventHandler(
            'main',
            'OnProlog',
            $this->MODULE_ID,
            ErrorHandler::class,
            'catch'
        );
    }

}
