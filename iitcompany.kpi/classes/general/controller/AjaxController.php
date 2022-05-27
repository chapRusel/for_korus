<?php

namespace IITCompany\KPI\Controller;

use Bitrix\Main\Application;
use Bitrix\Main\Loader;

class AjaxController extends BaseController
{
    private $request;
    private $result;

    public function __construct()
    {
        $this->request = Application::getInstance()->getContext()->getRequest();
        $this->checkSessid();
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    public function run()
    {
        $this->updateDeal();
        $this->updateKPI();
        $this->result = true;
    }

    private function checkSessid()
    {
        if (!check_bitrix_sessid()) {
            throw new \Exception('Ваша сессия истекла');
        }
    }

    private function getFieldsFromRequest(): array
    {
        $arFields = [];

        foreach ($this->request->toArray() as $name => $value) {
            if ($name === 'sessid' ||
                $name === 'dealId' ||
                $name === 'stageId') continue;

            $arFields[$name] = $value;
        }

        return $arFields;
    }

    private function getFilesFromRequest(): array
    {
        $arResult = [];
        $arFiles = $this->request->getFileList();

        foreach ($arFiles as $fieldName => $arFile) {
            if (strlen($arFile['name']) > 0) {
                $arResult[$fieldName] = $arFile;
            }
        }

        return $arResult;
    }

    private function updateDeal()
    {
        Loader::includeModule('crm');

        $deal = new \CCrmDeal(false);
        $arFields = $this->getFieldsFromRequest();
        $arFiles = $this->getFilesFromRequest();
        $arResult = array_merge($arFields, $arFiles);

        $result = $deal->Update($this->request['dealId'], $arResult);

        if (!$result) {
            throw new \Exception('Не удалось обновить сделку');
        }
    }

    private function updateKPI()
    {
        $role = KPIController::getRoleEmployee($this->request['dealId'], $this->request['stageId']);
        $role->calculateKPI();
    }
}