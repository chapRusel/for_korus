<?php

defined('B_PROLOG_INCLUDED') || die;

use IITCompany\KPI\Entity\KPITable;
use Bitrix\Main\Loader;

class IITCompanyReportKPIUserComponent extends CBitrixComponent
{
    const MODULE_ID = 'iitcompany.kpi';
    const GRID_ID = 'kpi_report_user';
    const GRID_HEAD = [
        ['id' => 'ID', 'name' => 'ID', 'sort' => 'ID', 'default' => true],
        ['id' => 'DEAL_NAME', 'name' => 'Наименование сделки', 'sort' => 'DEAL_NAME', 'default' => true],
        ['id' => 'KPI', 'name' => 'Уровень KPI - %', 'sort' => 'KPI', 'default' => true],
        [
            'id' => 'EMPTY_FIELDS',
            'name' => 'Список незаполненных полей',
            'sort' => 'EMPTY_FIELDS',
            'default' => true
        ],
    ];

    private $userRows;
    private $userId;
    protected $request;

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function __construct(CBitrixComponent $component = null)
    {
        Loader::includeModule(self::MODULE_ID);
        Loader::includeModule('crm');

        $this->request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
        parent::__construct($component);
    }

    public function executeComponent()
    {
        $this->arResult['GRID_ID'] = self::GRID_ID;
        $this->arResult['GRID_HEAD'] = self::GRID_HEAD;

        if ($this->request['user_id']) {
            $this->userId = $this->request['user_id'];

            $this->prepareData();
            $this->buildRowData();
        }

        $this->includeComponentTemplate();
    }

    /**
     * Prepare users data
     *
     * @return void
     */
    private function prepareData()
    {
        $this->arResult['USER_ID'] = $this->userId;

        $this->fetchUserRows();
        $this->fetchUserDeals();
    }

    /**
     * Building report
     *
     * @return void
     */
    private function buildRowData()
    {
        foreach ($this->userRows as $key => $row) {
            $this->arResult['ROWS'][] = [
                'data' => [
                    'ID' => ++$key,
                    'DEAL_NAME' => $row['DEAL_NAME'],
                    'KPI' => "{$row['KPI']}%",
                    'EMPTY_FIELDS' => $row['EMPTY_FIELDS']
                ],
            ];
        }
    }

    private function fetchUserRows()
    {
        $this->userRows = KPITable::getList(
            [
                'filter' => ['USER_ID' => $this->userId]
            ]
        )->fetchAll();
    }

    private function fetchUserDeals()
    {
        foreach ($this->userRows as &$row) {
            $arDeal = \CCrmDeal::GetListEx([], ['ID' => $row['DEAL_ID'], false, false, ['TITLE', 'ID']])->Fetch();
            $row['DEAL_NAME'] = "<a href='/crm/deal/details/{$row['DEAL_ID']}/'>{$arDeal['TITLE']}</a>";
        }

        unset($row);
    }
}