<?php

namespace IIT\Notify\App\Repositories\Notify;

use IIT\Entity\Helper\HlHelper;
use IIT\Illuminate\App\Repositories\EloquentRepository;
use IIT\Notify\App\Models\Notify\NotifyList as Model;
use IIT\Notify\Src\Classes\Managers\Notify\NotifyManager;

class NotifyListRepository extends EloquentRepository
{
    public function __construct()
    {
        return $this->setModel(Model::class);
    }

    /**
     * Getting unsent notifies for send to websocket
     *
     * @param int $userId
     * @return array
     */
    public function getUnsentForWebsocket(int $userId): array
    {
        $result = $this->getModel()
            ->where('UF_USER', $userId)
            ->orWhere(function($query) {
                $query->where('UF_SENT_IN_BROWSER', 0)
                    ->orWhere('UF_SENT_IN_SITE', 0);
            })
            ->get()
            ->toArray();

        return $result;
    }

    /**
     * Added new row in notify list via bitrix HL class
     *
     * @param array $arFields
     * @return void
     */
    public function add(array $arFields)
    {
        $tableName = $this->getModel()->getTable();

        $hlHelper = new HlHelper();
        $arHlBlock = $hlHelper->getBlockByTableName($tableName);
        $hlHelper->setHlBlockId($arHlBlock['ID']);
        $hlHelper->add($arFields);
    }
}