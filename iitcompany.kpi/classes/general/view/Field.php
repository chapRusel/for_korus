<?php

namespace IITCompany\KPI\View;

class Field
{
    protected $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function render(): string
    {
        global $USER_FIELD_MANAGER;

        $html = "
            <div class='ui-entity-editor-block-title ui-entity-widget-content-block-title-edit'>
                <label class='ui-entity-editor-block-title-text'>{$this->field['EDIT_FORM_LABEL']}</label>
            </div>  
        ";

        if ($this->field['USER_TYPE_ID'] === 'file') {
            $html .= "
                <div class='ui-entity-editor-content-block'>
                    <span class='field-wrap'>
                        <ol class='webform-field-upload-list webform-field-upload-list-single'></ol>
                        <span class='field-item'>
                            <div class='webform-field-upload' style='position: relative;'>
                                <span class='webform-small-button webform-button-upload'>
                                    Добавить файл
                                </span>
                                <span class='webform-small-button webform-button-replace' style='display: none;'>
                                    Заменить файл
                                </span>
                                <input type='file' name='{$this->field['FIELD_NAME']}' style='margin-top: 0; margin-left: 0; height: 100%; cursor: pointer;'>
                            </div>
                        </span>
                    </span>
                </div>
            ";
        } else {
            $html .= $USER_FIELD_MANAGER->GetPublicEdit($this->field);
        }

        return $html;
    }
}