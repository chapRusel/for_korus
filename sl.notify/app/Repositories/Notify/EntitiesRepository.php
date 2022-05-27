<?php

namespace IIT\Notify\App\Repositories\Notify;

use IIT\Illuminate\App\Repositories\EloquentRepository;
use IIT\Notify\App\Models\Notify\Entities as Model;

class EntitiesRepository extends EloquentRepository
{
    public function __construct()
    {
        return $this->setModel(Model::class);
    }

    /**
     * Gets an entity by class name
     *
     * @param string $className
     * @return array
     */
    public function getByClassName(string $className): array
    {
        $result = $this->getModel()
            ->select('ID')
            ->where('UF_CLASS', $className)
            ->first()
            ->toArray();

        return $result;
    }
}