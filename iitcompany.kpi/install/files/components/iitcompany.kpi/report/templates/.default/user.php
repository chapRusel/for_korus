<?php
defined('B_PROLOG_INCLUDED') || die;

/** @var CBitrixComponentTemplate $this */

$APPLICATION->SetTitle('Отчет одного сотрудника');

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
        'MORE_BUTTON' => false
    )
);

$APPLICATION->IncludeComponent(
    'iitcompany.kpi:report.user',
    '',
    [],
    $this->getComponent(),
    array('HIDE_ICONS' => 'Y',)
);