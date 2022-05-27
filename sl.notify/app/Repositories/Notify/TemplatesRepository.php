<?php

namespace IIT\Notify\App\Repositories\Notify;

use IIT\Illuminate\App\Repositories\EloquentRepository;
use IIT\Notify\App\Models\Notify\Templates as Model;

class TemplatesRepository extends EloquentRepository
{
    public function __construct()
    {
        return $this->setModel(Model::class);
    }

    /**
     * Getting template for handler
     *
     * @param int $entityId
     * @param int $actionId
     * @return array
     */
    public function getForHandler(int $entityId, int $actionId): array
    {
        $result = $this->getModel()
            ->select(['UF_USERS', 'UF_MESSAGE'])
            ->where(
                [
                    ['UF_ENTITY', $entityId],
                    ['UF_ACTION', $actionId]
                ]
            )
            ->first()
            ->toArray();

        return $result;
    }
}