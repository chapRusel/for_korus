<?php
use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    'iitcompany.kpi',
    [
        'IITCompany\KPI\Controller\BaseController' => 'classes/general/controller/BaseController.php',
        'IITCompany\KPI\Controller\PullController' => 'classes/general/controller/PullController.php',
        'IITCompany\KPI\Controller\HandlerController' => 'classes/general/controller/HandlerController.php',
        'IITCompany\KPI\Controller\ResponseController' => 'classes/general/controller/ResponseController.php',
        'IITCompany\KPI\Controller\AjaxController' => 'classes/general/controller/AjaxController.php',
        'IITCompany\KPI\Controller\FieldController' => 'classes/general/controller/FieldController.php',
        'IITCompany\KPI\Controller\KPIController' => 'classes/general/controller/KPIController.php',
        'IITCompany\KPI\Strategy\Employee' => 'classes/general/strategy/Employee.php',
        'IITCompany\KPI\Strategy\Seller' => 'classes/general/strategy/Seller.php',
        'IITCompany\KPI\Strategy\Manager' => 'classes/general/strategy/Manager.php',
        'IITCompany\KPI\Strategy\Production' => 'classes/general/strategy/Production.php',
        'IITCompany\KPI\View\Form' => 'classes/general/view/Form.php',
        'IITCompany\KPI\View\Field' => 'classes/general/view/Field.php',
        'IITCompany\KPI\Entity\KPITable' => 'classes/general/entity/KPITable.php',
    ]
);
