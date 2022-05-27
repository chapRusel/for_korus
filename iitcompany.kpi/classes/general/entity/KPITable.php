<?php

namespace IITCompany\KPI\Entity;

use Bitrix\Crm\DealTable;
use Bitrix\Main\Entity\TextField;
use Bitrix\Main\UserTable;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\ReferenceField;

class KPITable extends DataManager
{
    public static function getTableName()
    {
        return 'iit_kpi';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            new IntegerField('KPI'),
            (new TextField('EMPTY_FIELDS'))
                ->addSaveDataModifier(function($fields) {
                    $arItems = [];

                    foreach ($fields as $item) {
                        $userField = \CUserTypeEntity::GetList(
                            [],
                            ['ENTITY_ID' => 'CRM_DEAL', 'FIELD_NAME' => $item, 'LANG' => 'ru']
                        )->Fetch();

                        if ($userField) {
                            $arItems[] = $userField['EDIT_FORM_LABEL'];
                        }
                    }

                    return implode(', ', $arItems);
                }),
            new IntegerField('ROLE'),
            new IntegerField('USER_ID'),
            new IntegerField('DEAL_ID'),

            new ReferenceField(
                'USER',
                UserTable::getEntity(),
                ['=this.USER_ID' => 'ref.ID']
            ),

            new ReferenceField(
                'DEAL',
                DealTable::getEntity(),
                ['=this.DEAL_ID' => 'ref.ID']
            )
        ];
    }
}