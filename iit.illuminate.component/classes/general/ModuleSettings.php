<?php

namespace IIT\Illuminate;

use Bitrix\Main\ORM\Data\UpdateResult;

class ModuleSettings
{
    /**
     * @throws \Exception
     */
    public static function update(array $fields): UpdateResult
    {
        $eloquent = [];
        $validation = [];
        $operating_mode = [];
        foreach ($fields as $key => $field) {
            if (strpos($key, 'ELOQUENT') !== false) {
                $eloquent[$key] = $field;
            } elseif (strpos($key, 'VALIDATION') !== false) {
                $validation[$key] = $field;
            } elseif (strpos($key, 'OPERATING_MODE') !== false) {
                $operating_mode[$key] = $field;
            }
        }

        return \IIT\Illuminate\Component\SettingsTable::update(
            1,
            [
                'eloquent'       => json_encode($eloquent, JSON_THROW_ON_ERROR),
                'validation'     => json_encode($validation, JSON_THROW_ON_ERROR),
                'operating_mode' => json_encode($operating_mode, JSON_THROW_ON_ERROR),
            ]
        );
    }

    /**
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentException
     */
    public static function get(array $fields = []): ?array
    {
        return \IIT\Illuminate\Component\SettingsTable::getRow(
            [
                'filter' => ['ID' => 1],
                'select' => [$fields['select'] ?: '*']
            ]
        );
    }

    public static function isProductionMode(): bool
    {
        $result = \IIT\Illuminate\Component\SettingsTable::getRow(
            [
                'filter' => ['ID' => 1],
                'select' => ['operating_mode']
            ]
        );

        $result = json_decode($result['operating_mode'], true);

        return $result['OPERATING_MODE_PRODUCTION'] === 'Y';
    }
}
