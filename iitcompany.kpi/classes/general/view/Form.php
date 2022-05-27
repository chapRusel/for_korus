<?php

namespace IITCompany\KPI\View;

use IITCompany\KPI\Controller\BaseController;

class Form
{
    private $html;
    private $arFields;

    public function __construct($arFieldCodes)
    {
        $this->arFields = [];

        foreach ($arFieldCodes as $fieldCode) {
            $userField = \CUserTypeEntity::GetList(
                [],
                ['ENTITY_ID' => BaseController::FIELD_ENTITY, 'FIELD_NAME' => $fieldCode, 'LANG' => 'ru']
            )->Fetch();

            if ($userField) {
                $this->arFields[] = $userField;
            }
        }
    }

    public function renderHeader()
    {
        $this->html = "
            <form action='/local/modules/iitcompany.kpi/tools/ajax.php' enctype='multipart/form-data' method='POST'>
                <div class='ui-entity-editor-content-block-edit'>
        ";
    }

    public function renderFields()
    {
        foreach ($this->arFields as $field) {
            $fieldView = new Field($field);
            $this->html .= $fieldView->render();
        }
    }

    public function renderFooter()
    {
        $this->html .= "
                </div>
            </form>
            <div class='error-container' style='display: none; margin: 10px 0;'></div>
        ";
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }
}