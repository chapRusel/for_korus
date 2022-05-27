<?php

namespace IIT\Notify\Src\Classes\Controller;

use Bitrix\Main\Entity\Event;
use IIT\Notify\App\Repositories\Notify\EntitiesRepository;
use IIT\Notify\App\Repositories\Notify\NotifyListRepository;
use IIT\Notify\App\Repositories\Notify\TemplatesRepository;

class HandlerController
{
    public static function OnAfterAdd(Event $event)
    {
        self::addNotify($event, 'OnAfterAdd');
    }

    public static function OnAfterUpdate(Event $event)
    {
        self::addNotify($event, 'OnAfterUpdate');
    }

    public static function OnAfterDelete(Event $event)
    {
        self::addNotify($event, 'OnAfterDelete');
    }

    public static function afterNotifyAdd(Event $event)
    {
        $fields = $event->getParameter('fields');
        $id = $event->getParameter('id');
        $fields['ID'] = $id;

        $notifyController = new NotifyController($fields);
        $notifyController->send();
    }

    private static function findTemplate(string $className, string $action): array
    {
        $templatesRepository = new TemplatesRepository();
        $entitiesRepository = new EntitiesRepository();
        $arEnum = \CUserFieldEnum::GetList([], ['XML_ID' => $action])->Fetch();

        $entity = $entitiesRepository->getByClassName($className);
        $arTemplate = $templatesRepository->getForHandler($entity['ID'], $arEnum['ID']);

        return [
            'TEMPLATE' => $arTemplate,
            'ENTITY_ID' => $entity['ID']
        ];
    }

    private static function addNotify(Event $event, $action)
    {
        $repo = new NotifyListRepository();
        $className = $event->getEntity()->getName();
        $arResult = self::findTemplate($className, $action);

        $arUsers = unserialize($arResult['TEMPLATE']['UF_USERS']);
        foreach ($arUsers as $userId) {
            $fields = [
                'UF_TITLE' => $arResult['TEMPLATE']['UF_MESSAGE'],
                'UF_USER' => $userId,
                'UF_ENTITY' => $arResult['ENTITY_ID']
            ];
            $repo->add($fields);
        }
    }
}