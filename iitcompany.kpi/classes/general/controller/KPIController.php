<?php

namespace IITCompany\KPI\Controller;

use IITCompany\KPI\Strategy\Employee;
use IITCompany\KPI\Strategy\Manager;
use IITCompany\KPI\Strategy\Production;
use IITCompany\KPI\Strategy\Seller;
use Bitrix\Main\Loader;

class KPIController extends BaseController
{
    public static function getRoleEmployee($dealId, $stageId): Employee
    {
        Loader::includeModule('crm');

        $role = false;
        $arRelations = self::RELATION_ROLES;
        $arDeal = \CCrmDeal::GetList([], ['ID' => $dealId], self::ROLES)->Fetch();

        if (in_array($stageId, $arRelations['SELLER'])) {
            $role = new Seller($dealId, $arDeal['UF_SELLER_ROLE']);
        } else if (in_array($stageId, $arRelations['MANAGER'])) {
            $role = new Manager($dealId, $arDeal['UF_MANAGER_ROLE']);
        } else if (in_array($stageId, $arRelations['PRODUCTION'])) {
            $role = new Production($dealId, $arDeal['UF_PRODUCTION_ROLE']);
        }

        if ($role) {
            return $role;
        } else {
            throw new \Exception('Не найдено сопоставлений роли со стадией: ' . $stageId);
        }
    }
}