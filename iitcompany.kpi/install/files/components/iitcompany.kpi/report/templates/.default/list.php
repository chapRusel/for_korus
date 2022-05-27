<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Localization\Loc;

/** @var CBitrixComponentTemplate $this */

$APPLICATION->SetTitle('Отчет KPI');

$APPLICATION->IncludeComponent(
    'bitrix:main.interface.buttons',
    '',
    array(
        'ID' => 'iitcompany.kpi',
        'ITEMS' => [
            [
                'TEXT' => 'Отчет всех сотрудников',
                'URL' => '/kpi/',
                'URL_CONSTANT' => false,
                'SORT' => 10,
            ],
            [
                'TEXT' => 'Отчет одного сотрудника',
                'URL' => '/kpi/user/',
                'URL_CONSTANT' => false,
                'SORT' => 20,
            ],
        ],
        "CLASS_ITEM_ACTIVE" => "main-buttons-item-active",
    )
);

$urlTemplates = array(
    'DETAIL' => $arResult['SEF_FOLDER'] . $arResult['SEF_URL_TEMPLATES']['details'],
    'EDIT' => $arResult['SEF_FOLDER'] . $arResult['SEF_URL_TEMPLATES']['edit'],
);

$APPLICATION->IncludeComponent(
    'iitcompany.kpi:report.all',
    '',
    [],
    $this->getComponent(),
    array('HIDE_ICONS' => 'Y',)
);