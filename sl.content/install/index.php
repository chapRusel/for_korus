<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\ModuleManager;


Loc::loadMessages(__FILE__);

class sl_content extends CModule
{
    public $eventManager;

    public function __construct()
    {
        $arModuleVersion = [];

        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_ID = 'sl.content';
        $this->MODULE_NAME = 'Работа со страницами';
        $this->MODULE_DESCRIPTION = '';
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = '';
        $this->PARTNER_URI = '';

        $this->eventManager = EventManager::getInstance();
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function DoUninstall()
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}
