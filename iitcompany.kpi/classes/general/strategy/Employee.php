<?php

namespace IITCompany\KPI\Strategy;

use Bitrix\Main\Loader;
use IITCompany\KPI\Entity\KPITable;

class Employee
{
    protected $dealId;
    protected $userId;
    protected $roleFields;
    protected $emptyFields = [];
    protected $filledFields = [];
    protected $kpi;
    protected $isSuccess = false;
    protected $roleTitle = '';
    protected $roleId = 0;

    public function __construct($dealId, $userId)
    {
        $this->dealId = $dealId;
        $this->userId = $userId;

        $this->checkParams();
    }

    public function calculateKPI() {
        $this->setFields();
        $this->kpi = round(
            count($this->filledFields) / count($this->roleFields) * 100
        );
        $row = KPITable::getList(
            [
                'filter' => ['DEAL_ID' => $this->dealId, 'USER_ID' => $this->userId],
                'limit' => 1
            ]
        )->fetch();

        if ($row) {
            $result = KPITable::update(
                $row['ID'],
                [
                    'KPI' => $this->kpi,
                    'EMPTY_FIELDS' => $this->emptyFields
                ]
            );

            if (!$result->isSuccess()) {
                throw new \Exception(implode(',' ,$result->getErrorMessages()));
            } else {
                $this->isSuccess = true;
            }
        } else {
            $result = KPITable::add(
                [
                    'KPI' => $this->kpi,
                    'EMPTY_FIELDS' => $this->emptyFields,
                    'ROLE' => $this->roleId,
                    'USER_ID' => $this->userId,
                    'DEAL_ID' => $this->dealId
                ]
            );

            if (!$result->isSuccess()) {
                throw new \Exception(implode(',' ,$result->getErrorMessages()));
            } else {
                $this->isSuccess = true;
            }
        }
    }

    protected function setFields()
    {
        Loader::includeModule('crm');

        $arDeal = \CCrmDeal::GetList([], ['ID' => $this->dealId], $this->roleFields)->Fetch();

        foreach ($arDeal as $fieldName => $fieldValue) {
            if ($fieldName === 'ID') {
                continue;
            } elseif (!$fieldValue) {
                $this->emptyFields[] = $fieldName;
            } else {
                $this->filledFields[] = $fieldName;
            }
        }
    }

    protected function checkParams()
    {
        if (!$this->dealId && $this->dealId <= 0) {
            throw new \Exception('Не указан ID сделки');
        }

        if (!$this->userId && $this->userId <= 0) {
            throw new \Exception('Не указан ID пользователя');
        }
    }

    /**
     * @return array
     */
    public function getRoleFields(): array
    {
        return $this->roleFields;
    }

    /**
     * @return int
     */
    public function getDealId(): int
    {
        return (int) $this->dealId;
    }

    /**
     * @return int
     */
    public function  getUserId(): int
    {
        return (int) $this->userId;
    }

    /**
     * @return array
     */
    public function getEmptyFields(): array
    {
        return $this->emptyFields;
    }

    /**
     * @return array
     */
    public function getFilledFields(): array
    {
        return $this->filledFields;
    }

    /**
     * @return mixed
     */
    public function getKpi()
    {
        return $this->kpi;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @return string
     */
    public function getRoleTitle(): string
    {
        return $this->roleTitle;
    }
}