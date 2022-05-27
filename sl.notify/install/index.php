<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\ModuleManager;


Loc::loadMessages(__FILE__);

class sl_notify extends CModule
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

        $this->MODULE_ID = 'sl.notify';
        $this->MODULE_NAME = 'Работа с уведомлениями';
        $this->MODULE_DESCRIPTION = '';
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = '';
        $this->PARTNER_URI = '';

        $this->eventManager = EventManager::getInstance();
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->InstallFields();
    }

    public function DoUninstall()
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);
        $this->UninstallFields();
    }

    private function InstallFields()
    {
        $arFieldUser = [
            'CODE' => 'UF_NOTIFY_SETTINGS',
            'TYPE' => 'string',
            'NAME' => 'Настройки уведомлений',
            'SORT' => 10,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'N',
            'EDIT_IN_LIST' => 'N'
        ];

        $this->addUserField($arFieldUser, 'USER');
    }

    private function UninstallFields()
    {
        $userTypeEntity = new CUserTypeEntity();

        $arField = $userTypeEntity->GetList([], ['FIELD_NAME' => 'UF_NOTIFY_SETTINGS'])->Fetch();
        $userTypeEntity->Delete($arField['ID']);
    }

    private function addUserField($arField, $entityId)
    {
        $userTypeData = [
            'ENTITY_ID'         => $entityId,
            'FIELD_NAME'        => $arField['CODE'],
            'USER_TYPE_ID'      => $arField['TYPE'],
            'XML_ID'            => $arField['CODE'],
            'SORT'              => $arField['SORT'] ?: 500,
            'MULTIPLE'          => $arField['MULTIPLE'] ?: 'N',
            'MANDATORY'         => $arField['MANDATORY'] ?: 'N',
            'SHOW_FILTER'       => $arField['SHOW_FILTER'] ?: 'N',
            'SHOW_IN_LIST'      => $arField['SHOW_IN_LIST'] ?: 'Y',
            'EDIT_IN_LIST'      => $arField['EDIT_IN_LIST'] ?: 'Y',
            'IS_SEARCHABLE'     => $arField['IS_SEARCHABLE'] ?: 'N',
            'SETTINGS'          => $arField['SETTINGS'] ?: [
                'DEFAULT_VALUE' => '',
                'SIZE'          => '20',
                'ROWS'          => '1',
                'MIN_LENGTH'    => '0',
                'MAX_LENGTH'    => '0',
                'REGEXP'        => ''
            ],
            'EDIT_FORM_LABEL'   => ['ru'    => $arField['NAME'] ?: $arField['CODE']],
            'LIST_COLUMN_LABEL' => ['ru'    => $arField['NAME'] ?: $arField['CODE']],
            'LIST_FILTER_LABEL' => ['ru'    => $arField['NAME'] ?: $arField['CODE']]
        ];
        $userTypeEntity = new CUserTypeEntity();
        return $userTypeEntity->Add($userTypeData);
    }
}
