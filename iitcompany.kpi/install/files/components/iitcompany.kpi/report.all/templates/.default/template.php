<?php

defined('B_PROLOG_INCLUDED') || die;

/** @var CBitrixComponentTemplate $this */

$APPLICATION->IncludeComponent('bitrix:main.ui.grid', '', [
    'GRID_ID' => $arResult['MODULE_ID'],
    'COLUMNS' => $arResult['GRID_HEAD'],
    'ROWS' => $arResult['ROWS'],
    'SHOW_ROW_CHECKBOXES' => false,
    'SHOW_CHECK_ALL_CHECKBOXES' => false,
    'SHOW_ROW_ACTIONS_MENU' => true,
    'SHOW_GRID_SETTINGS_MENU' => false,
    'SHOW_NAVIGATION_PANEL' => false,
    'SHOW_PAGINATION' => false,
    'SHOW_SELECTED_COUNTER' => false,
    'SHOW_TOTAL_COUNTER' => false,
    'SHOW_PAGESIZE' => false,
    'ALLOW_COLUMNS_SORT' => false,
    'ALLOW_COLUMNS_RESIZE' => false,
    'ALLOW_HORIZONTAL_SCROLL' => true,
    'ALLOW_SORT' => false,
    'ALLOW_PIN_HEADER' => false,
    'AJAX_MODE' => 'Y',
    'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
    'AJAX_OPTION_JUMP' => 'N',
    'AJAX_OPTION_HISTORY' => 'N',
    'TOTAL_ROWS_COUNT' => 10000,
    'SHOW_ACTION_PANEL' => false,
]);