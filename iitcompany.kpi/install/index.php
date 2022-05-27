<?php

use Bitrix\Main\UrlRewriter;
use Bitrix\Crm\StatusTable;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use IITCompany\KPI\Entity\KPITable;

Loc::loadMessages(__FILE__);

class iitcompany_kpi extends CModule
{
    public $MODULE_ID = 'iitcompany.kpi';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_GROUP_RIGHTS;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    private $eventManager;
    private $statuses;
    private $userFields;
    private $userTypeEntity;

    public function __construct()
    {
        $arModuleVersion = [];

        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = Loc::getMessage('IIT_KPI_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('IIT_KPI_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = 'IIT Company';
        $this->PARTNER_URI = 'https://iit.company';
        $this->eventManager = \Bitrix\Main\EventManager::getInstance();
        $this->userTypeEntity = new CUserTypeEntity();
        $this->statuses = require 'files/statuses.php';
        $this->userFields = require 'files/additional_fields.php';
    }

    protected function getPath(): string
    {
        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        $path = array_diff(explode('/', $path), array(''));
        array_pop($path);

        return '/'.implode('/', $path);
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

        $this->installDB();
        $this->installDependence();
        $this->installEvents();
        $this->installFiles();
        $this->installDealStatuses();
        $this->installFields();

        UrlRewriter::reindexAll();
    }

    public function installDB()
    {
        Loader::includeModule($this->MODULE_ID);

        $db = Application::getConnection();
        $entity = KPITable::getEntity();

        if (!$db->isTableExists($entity->getDBTableName())) {
            $entity->createDbTable();
        }
    }

    public function installDependence()
    {
        Loader::includeModule('pull');

        RegisterModuleDependences(
            "pull",
            "OnGetDependentModule",
            $this->MODULE_ID,
            "\IITCompany\KPI\Controller\PullController",
            "OnGetDependentModule"
        );
    }

    public function installEvents()
    {
        $this->eventManager->registerEventHandler(
            'crm',
            'OnAfterCrmDealUpdate',
            $this->MODULE_ID,
            '\IITCompany\KPI\Controller\HandlerController',
            'OnAfterCrmDealUpdate'
        );
        $this->eventManager->registerEventHandler(
            'main',
            'OnAfterEpilog',
            $this->MODULE_ID,
            '\IITCompany\KPI\Controller\HandlerController',
            'OnAfterEpilog'
        );
    }

    public function installFiles()
    {
        $documentRoot = \Bitrix\Main\Application::getDocumentRoot();

        CopyDirFiles(
            __DIR__ . '/files/js',
            $documentRoot .'/local/js',
            true,
            true
        );
        CopyDirFiles(
            __DIR__ . "/files/components/{$this->MODULE_ID}",
            $documentRoot . "/local/components/{$this->MODULE_ID}",
            true,
            true
        );
        CopyDirFiles(
            __DIR__ . "/files/kpi",
            $documentRoot . "/kpi",
            true,
            true
        );
    }

    public function installDealStatuses()
    {
        Loader::includeModule('crm');

        foreach ($this->statuses as $item) {
            $this->addStatus($item['NAME'], $item['SORT'], $item['STATUS_ID']);
        }
    }

    public function installFields()
    {
        foreach ($this->userFields as $item) {
            $this->addUserField($item['FIELDS'], $item['ENTITY']);
        }
    }

    public function doUninstall()
    {
        $this->unInstallEvents();
        $this->unInstallDB();
        $this->unInstallFiles();
        $this->unInstallFields();
        $this->unInstallDependence();
        $this->unInstallDealStatuses();

        ModuleManager::unRegisterModule($this->MODULE_ID);
        UrlRewriter::reindexAll();
    }

    public function unInstallDB()
    {
        Loader::includeModule($this->MODULE_ID);

        $db = Application::getConnection();
        $entity = KPITable::getEntity();

        if ($db->isTableExists($entity->getDBTableName())) {
            $db->dropTable($entity->getDBTableName());
        }
    }

    public function unInstallFiles()
    {
        DeleteDirFilesEx('/local/js/iitcompany/kpi');
        DeleteDirFilesEx("/local/components/{$this->MODULE_ID}");
        DeleteDirFilesEx("/kpi");
    }

    public function unInstallDependence()
    {
        Loader::includeModule('pull');

        UnRegisterModuleDependences(
            "pull",
            "OnGetDependentModule",
            $this->MODULE_ID,
            "\IITCompany\KPI\Controller\PullController",
            "OnGetDependentModule"
        );
    }

    public function unInstallEvents()
    {
        $this->eventManager->unRegisterEventHandler(
            'crm',
            'OnAfterCrmDealUpdate',
            $this->MODULE_ID,
            '\IITCompany\KPI\Controller\HandlerController',
            'OnAfterCrmDealUpdate'
        );
        $this->eventManager->unRegisterEventHandler(
            'main',
            'OnAfterEpilog',
            $this->MODULE_ID,
            '\IITCompany\KPI\Controller\HandlerController',
            'OnAfterEpilog'
        );
    }

    public function unInstallDealStatuses()
    {
        global $APPLICATION;

        foreach ($this->statuses as $item) {
            $status = StatusTable::getList(
                [
                    'filter' => [
                        'NAME' => $item['NAME'],
                        'SYSTEM' => 'N',
                        'ENTITY_ID' => 'DEAL_STAGE_7',
                        'CATEGORY_ID' => 7
                    ],
                    'limit' => 1
                ]
            )->fetch();

            if ($status) {
                dump($status, false);
                $result = StatusTable::delete($status['ID']);

                if (!$result->isSuccess()) {
                    $APPLICATION->ThrowException(implode("", $result->getErrorMessages()));
                    return false;
                }
            }
        }
    }

    public function unInstallFields()
    {
        foreach ($this->userFields as $item) {
            $userField = CUserTypeEntity::GetList(
                [],
                ['ENTITY_ID' => $item['ENTITY'], 'FIELD_NAME' => $item['FIELDS']['CODE']]
            )->Fetch();

            if ($userField) {
                $this->userTypeEntity->Delete($userField['ID']);
            }
        }
    }

    private function addStatus($name, $sort, $statusId, $color = '#EBEBEB')
    {
        global $APPLICATION;

        $result = StatusTable::add(
            [
                'ENTITY_ID'    => 'DEAL_STAGE_7',
                'STATUS_ID'    => $statusId,
                'NAME'        => $name,
                'NAME_INIT'    => '',
                'SORT'        => $sort,
                'SYSTEM'    => 'N',
                'CATEGORY_ID' => 7,
                'COLOR' => $color,
                'SEMANTICS' => null,
            ]
        );

        if (!$result->isSuccess()) {
            $APPLICATION->ThrowException(implode("", $result->getErrorMessages()));
            return false;
        }
    }

    private function addUserField($arField, $entityId)
    {
        global $APPLICATION;

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

        $result = $this->userTypeEntity->Add($userTypeData);

        if (!$result) {
            $APPLICATION->ThrowException($APPLICATION->GetException());
        }
    }
}