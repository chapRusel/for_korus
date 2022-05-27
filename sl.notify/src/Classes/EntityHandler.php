<?php

namespace IIT\Notify\Src\Classes;

use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use IIT\Notify\App\Models\Notify\Entities;
use IIT\Notify\App\Models\Notify\Templates;

class EntityHandler
{
    public static function initEntityEvents()
    {
        if (self::checkTablesExists()) {
            $eventManager = EventManager::getInstance();

            $entities = new Entities();
            $templates = new Templates();

            $templateEntities = $templates->select(['UF_ENTITY', 'UF_ACTION'])
                ->get()
                ->toArray();

            foreach ($templateEntities as $entity) {
                $arEntity = $entities->select(['UF_CLASS'])
                    ->first($entity['UF_ENTITY'])
                    ->toArray();
                $arEnum = \CUserFieldEnum::GetList([], ['ID' => $entity['UF_ACTION']])->Fetch();

                $eventManager->addEventHandler(
                    '',
                    "{$arEntity['UF_CLASS']}{$arEnum['XML_ID']}",
                    ['\IIT\Notify\Src\Classes\Controller\HandlerController', $arEnum['XML_ID']]
                );
            }
        }
    }

    public static function initNotifyEvents()
    {
        $eventManager = EventManager::getInstance();

        $eventManager->addEventHandler(
            '',
            "SlNotifyListOnAfterAdd",
            ['\IIT\Notify\Src\Classes\Controller\HandlerController', 'afterNotifyAdd']
        );
    }

    private static function checkTablesExists()
    {
        return Application::getConnection()->isTableExists('sl_notify_templates') &&
            Application::getConnection()->isTableExists('sl_notify_entities');
    }
}