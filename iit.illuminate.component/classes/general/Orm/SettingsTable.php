<?php
namespace IIT\Illuminate\Component;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);

/**
 * Class SettingsTable
 *
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> eloquent string(5000) mandatory
 * <li> validation string(5000) mandatory
 * <li> operating_mode string(5000) mandatory
 * </ul>
 *
 * @package Bitrix\Component
 **/

class SettingsTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'illuminate_component_settings';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            new IntegerField(
                'id',
                [
                    'primary' => true,
                    'autocomplete' => true,
                    'title' => Loc::getMessage('SETTINGS_ENTITY_ID_FIELD')
                ]
            ),
            new StringField(
                'eloquent',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateEloquent'],
                    'title' => Loc::getMessage('SETTINGS_ENTITY_ELOQUENT_FIELD')
                ]
            ),
            new StringField(
                'validation',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateValidation'],
                    'title' => Loc::getMessage('SETTINGS_ENTITY_VALIDATION_FIELD')
                ]
            ),
            new StringField(
                'operating_mode',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateOperatingMode'],
                    'title' => Loc::getMessage('SETTINGS_ENTITY_OPERATING_MODE_FIELD')
                ]
            ),
        ];
    }

    /**
     * Returns validators for eloquent field.
     *
     * @return array
     */
    public static function validateEloquent()
    {
        return [
            new LengthValidator(null, 5000),
        ];
    }

    /**
     * Returns validators for validation field.
     *
     * @return array
     */
    public static function validateValidation()
    {
        return [
            new LengthValidator(null, 5000),
        ];
    }

    /**
     * Returns validators for operating_mode field.
     *
     * @return array
     */
    public static function validateOperatingMode()
    {
        return [
            new LengthValidator(null, 5000),
        ];
    }
}
