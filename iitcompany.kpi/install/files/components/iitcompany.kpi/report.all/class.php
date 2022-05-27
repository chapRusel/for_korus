<?php

defined('B_PROLOG_INCLUDED') || die;

use IITCompany\KPI\Entity\KPITable;
use Bitrix\Main\Loader;

class IITCompanyReportKPIAllComponent extends CBitrixComponent
{
    const MODULE_ID = 'iitcompany.kpi';
    const GRID_ID = 'kpi_report';
    const GRID_HEAD = [
        ['id' => 'ID', 'name' => '№', 'sort' => 'ID', 'default' => true],
        ['id' => 'NAME', 'name' => 'ФИО сотрудника', 'sort' => 'NAME', 'default' => true],
        ['id' => 'KPI', 'name' => 'Уровень KPI - %', 'sort' => 'KPI', 'default' => true],
    ];

    private $users;

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function __construct(CBitrixComponent $component = null)
    {
        Loader::includeModule(self::MODULE_ID);
        parent::__construct($component);
    }

    public function executeComponent()
    {
        $this->arResult['MODULE_ID'] = self::MODULE_ID;
        $this->arResult['GRID_ID'] = self::GRID_ID;
        $this->arResult['GRID_HEAD'] = self::GRID_HEAD;

        $this->prepareData();
        $this->buildRowData();
        $this->includeComponentTemplate();
    }

    /**
     * Prepare users data
     *
     * @return void
     */
    private function prepareData()
    {
        $this->fetchUsers();
        $this->fetchUsersKpi();
        $this->calculateKPIForUsers();
        $this->fetchUsersName();
    }

    /**
     * Building report
     *
     * @return void
     */
    private function buildRowData()
    {
        foreach ($this->users as $key => $arUser) {
            $this->arResult['ROWS'][] = [
                'data' => [
                    'ID' => $key + 1,
                    'NAME' => "<a href='{$arUser['PROFILE_LINK']}'>{$arUser['NAME']}</a>",
                    'KPI' => "{$arUser['AVERAGE_KPI']}%",
                ],
            ];
        }
    }

    private function fetchUsers()
    {
        $this->users = KPITable::getList(
            [
                'select' => [
                    'USER_ID'
                ],
                'group' => [
                    'USER_ID'
                ]
            ]
        )->fetchAll();
    }

    private function fetchUsersKpi()
    {
        foreach ($this->users as &$user) {
            $rowsCurrentUser = KPITable::getList(
                [
                    'filter' => ['USER_ID' => $user['USER_ID']],
                    'select' => [
                        'KPI'
                    ]
                ]
            )->fetchAll();

            foreach ($rowsCurrentUser as $item) {
                $user['ALL_KPI'][] = $item['KPI'];
            }
        }

        unset($user);
    }

    private function calculateKPIForUsers()
    {
        foreach ($this->users as &$arUser) {
            $countKPI = count($arUser['ALL_KPI']);
            $currentKpi = 0;

            foreach ($arUser['ALL_KPI'] as $kpi) {
                $currentKpi += intval($kpi);
            }

            $arUser['AVERAGE_KPI'] = $currentKpi / $countKPI;
        }

        unset($arUser);
    }

    private function fetchUsersName()
    {
        foreach ($this->users as &$arUser) {
            $user = \CUser::GetByID($arUser['USER_ID'])->Fetch();
            $arUser['NAME'] = "{$user['LAST_NAME']} {$user['NAME']} {$user['SECOND_NAME']}";
            $arUser['PROFILE_LINK'] = "/company/personal/user/{$arUser['USER_ID']}/";
        }

        unset($arUser);
    }
}