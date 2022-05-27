<?php

namespace IIT\Illuminate\App\Services;

use IIT\Illuminate\App\Repositories\EloquentRepository;

/**
 * Class Service
 *
 * @package IIT\Illuminate\App\Services
 */
class Service
{

    private string $model;
    private $repository;

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param  string  $model
     *
     * @return $this
     */
    public function setModel(string $model): Service
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return \IIT\Illuminate\App\Repositories\EloquentRepository
     */
    public function getRepository(): EloquentRepository
    {
        return $this->repository;
    }

    /**
     * @param  string  $repository
     * @param  array   $hiddenFields
     *
     * @return $this
     */
    public function setRepository(string $repository, array $hiddenFields = []): Service
    {
        $this->repository = new $repository();
        $this->repository->setModel($this->getModel())->setHiddenFields($hiddenFields);

        return $this;
    }


}
