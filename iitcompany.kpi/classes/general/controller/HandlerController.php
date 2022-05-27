<?php

namespace IITCompany\KPI\Controller;

use Bitrix\Main\Loader;

class HandlerController extends BaseController
{
    public static function OnAfterCrmDealUpdate($arFields)
    {
        global $USER;

        $userId = $USER->GetID();

        if ($arFields['STAGE_ID']) {
            PullController::startPullStack($userId, $arFields);
        }
    }

    public static function OnAfterEpilog()
    {
        global $APPLICATION, $USER;

        $url = $APPLICATION->GetCurDir();

        if (strpos($url, 'crm/deal/details/') !== false) {
            preg_match('|crm/deal/details/(\d+)|', $url, $arMatches);
            $dealId = $arMatches[1];

            if ($dealId) {
                Loader::includeModule('crm');

                $arDeal = \CCrmDeal::GetListEx(
                    [],
                    ['ID' => $dealId],
                    false,
                    false,
                    ['ID', 'TITLE', 'UF_DEAL_SUMM', 'STAGE_ID', 'UF_MANAGER_ROLE', 'UF_PRODUCTION_ROLE', 'UF_SELLER_ROLE']
                )->Fetch();

                if (!$arDeal['UF_DEAL_SUMM'] &&
                    $arDeal['STAGE_ID'] === 'C7:NEW' &&
                    ($arDeal['UF_SELLER_ROLE'] || $arDeal['UF_MANAGER_ROLE'] || $arDeal['UF_PRODUCTION_ROLE'])
                ) {
                    PullController::startPullStack($USER->GetID(), $arDeal);
                }
            }
        }
    }
}