<?php

namespace IIT\Illuminate\App\Repositories;

use IIT\Illuminate\App\Models\Base;
use Illuminate\Http\UploadedFile;

interface EloquentRepositoryInterface
{
    /**
     * @param  array  $fields
     *
     * @return $this
     */
    public function setHiddenFields(array $fields): EloquentRepository;

    /**
     * @return array
     */
    public function getHiddenFields(): array;


    /**
     * @param $model
     *
     * @return $this
     */
    public function setModel($model): EloquentRepository;

    /**
     * @return Base
     */
    public function getModel(): Base;


    /**
     * @param  array  $data
     *
     * @return bool
     */
    public function save(array $data);


    /**
     * @param  array  $data
     *
     * @return \IIT\Illuminate\App\Models\Base|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data);

    /**
     * @param  array  $data
     *
     * @return bool
     */
    public function insert(array $data): bool;


    /**
     * @param  int    $id
     * @param  array  $data
     * @param  bool   $isPropertyTable
     *
     * @return bool
     */
    public function update(int $id, array $data, bool $isPropertyTable = false);


    /**
     * @param  int             $id
     * @param  string|false    $scope
     * @param  array|string[]  $columns
     * @param  array           $relations
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function get(
        int $id,
        $scope = false,
        array $columns = [ '*' ],
        array $relations = []
    );


    /**
     * @param  array         $request
     * @param  string|false  $scope
     * @param  bool          $hasPaginate
     * @param  array         $relations
     * @param  array         $searchFields
     * @param  array         $groupBy
     *
     * @return mixed
     */
    public function index(
        array $request = [],
        $scope = false,
        bool $hasPaginate = false,
        array $relations = [],
        array $searchFields = [],
        array $groupBy = []
    );


    /**
     * @param  int  $id
     *
     * @return bool|null
     */
    public function delete(int $id): ?bool;

    /**
     * @param  array  $ids
     *
     * @return bool|null
     */
    public function massDelete(array $ids): ?bool;

    /**
     * @param  int    $id
     * @param  array  $relation
     *
     * @return mixed
     */
    public function deleteWithRelation(int $id, array $relation);


    /**
     * @param  int     $id
     * @param  string  $fileIdColumn
     *
     * @return bool|null
     */
    public function deleteWithFile(int $id, string $fileIdColumn): ?bool;


    /**
     * @param  int     $id
     * @param  string| bool  $propertyTable
     * @param  array   $fileRelation
     *
     * @return array
     */
    public function deleteWithProperty(int $id, $propertyTable,  array $fileRelation = []): array;


    /**
     * @param  string  $fieldName
     *
     * @return array
     */
    public function getFields(string $fieldName = ''): array;


    /**
     * @param  \Illuminate\Http\UploadedFile  $file
     *
     * @return false|int|string
     */
    public function createFile(Uploadedfile $file);
}
