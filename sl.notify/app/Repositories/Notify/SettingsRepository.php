<?php

namespace IIT\Notify\App\Repositories\Notify;

use IIT\Illuminate\App\Repositories\EloquentRepository;
use IIT\Notify\App\Models\Notify\Settings as Model;

class SettingsRepository extends EloquentRepository
{
    public function __construct()
    {
        return $this->setModel(Model::class);
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getUserSettingsForEntity(int $userId, int $entityId): array
    {
        $result = $this->getModel()
            ->where(
                [
                    ['UF_USER', $userId],
                    ['UF_ENTITY', $entityId],
                ]
            )
            ->get()
            ->toArray();

        return $result;
    }

    /**
     * Getting xml id for user property UF_SEND_TYPE
     *
     * @param int $enumId
     * @return string
     */
    public function getTypeXmlId(int $enumId): string
    {
        $arEnum = \CUserFieldEnum::GetList([], ['ID' => $enumId])->Fetch();

        return $arEnum['XML_ID'];
    }
}