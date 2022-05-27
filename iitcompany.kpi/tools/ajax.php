<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use IITCompany\KPI\Controller\ResponseController;

Loader::includeModule('iitcompany.kpi');

try {
    $ajax = new \IITCompany\KPI\Controller\AjaxController();
    $ajax->run();
    $result = $ajax->getResult();
    $response = new ResponseController(true, $result);

    echo json_encode($response->getResponse());
} catch (\Exception $e) {
    $response = new ResponseController(false, $e->getMessage());

    echo json_encode($response->getResponse());
}
