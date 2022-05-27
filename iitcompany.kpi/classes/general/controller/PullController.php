<?php

namespace IITCompany\KPI\Controller;

use Bitrix\Main\Loader;
use IITCompany\KPI\View\Form;

class PullController extends BaseController
{
    public static function OnGetDependentModule()
    {
        return [
            'MODULE_ID' => self::MODULE_ID,
            'USE' => ["PUBLIC_SECTION"]
        ];
    }

    public static function startPullStack($userId, $dealFields)
    {
        $stages = self::STAGES;
        $roleField = $stages[$dealFields['STAGE_ID']];

        if ($roleField) {
            $form = new Form($roleField);
            $form->renderHeader();
            $form->renderFields();
            $form->renderFooter();
            $html = $form->getHtml();

            self::addPullStack(
                $userId,
                [
                    'html' => $html,
                    'dealId' => $dealFields['ID'],
                    'stageId' => $dealFields['STAGE_ID'],
                ]
            );
        }
    }

    private static function addPullStack($userId, $arFields)
    {
        Loader::includeModule('pull');

        try {
            static::checkPullModule();

            define('BX_CHECK_AGENT_START', true);
            \CPullStack::AddByUser(
                $userId,
                [
                    'module_id' => self::MODULE_ID,
                    'command' => 'update',
                    'params' => $arFields,
                ]
            );
        } catch (\Exception $e) {
            \CEventLog::Add(
                [
                    "SEVERITY" => "INFO",
                    "AUDIT_TYPE_ID" => 'IIT.LOG',
                    "MODULE_ID" => self::MODULE_ID,
                    "ITEM_ID" => $userId,
                    "DESCRIPTION" => $e->getMessage(),
                ]
            );
        }
    }

    private static function checkPullModule()
    {
        Loader::includeModule('pull');

        $pushOn = \CPullOptions::GetPushStatus();

        if (!$pushOn) {
            throw new \Exception('Не включена опция для отправки Push уведомлений');
        }
    }
}