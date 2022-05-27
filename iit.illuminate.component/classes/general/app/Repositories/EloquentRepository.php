<?php

namespace IIT\Illuminate\App\Repositories;

use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Http\UploadedFile;

class EloquentRepository implements EloquentRepositoryInterface
{
    /**
     * @var array
     */
    protected array $hiddenFields = [];
    /**
     * @var Base
     */
    protected Base $model;


    /**
     * @param  array  $fields
     *
     * @return $this
     */
    public function setHiddenFields(array $fields): EloquentRepository
    {
        $this->hiddenFields = $fields;

        return $this;
    }

    /**
     * @return array
     */
    public function getHiddenFields(): array
    {
        return $this->hiddenFields ?: [];
    }


    /**
     * @param $model
     *
     * @return $this
     */
    public function setModel($model): EloquentRepository
    {
        $this->model = new $model();

        return $this;
    }

    /**
     * @return Base
     */
    public function getModel(): Base
    {
        return $this->model;
    }


    /**
     * @param  array  $data
     *
     * @return bool
     */
    public function save(array $data)
    {
        return $this->getModel()->firstOrNew($data)->save();
    }

    /**
     * @param  array  $data
     *
     * @return \IIT\Illuminate\App\Models\Base|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        return $this->getModel()->create($data);
    }

    /**
     * @param  array  $data
     *
     * @return bool
     */
    public function insert(array $data): bool
    {
        return $this->getModel()->insert($data);
    }


    /**
     * @param  int    $id
     * @param  array  $data
     * @param  bool   $isPropertyTable
     *
     * @return bool
     */
    public function update(int $id, array $data, bool $isPropertyTable = false)
    {
        if (!$isPropertyTable) {
            $element = $this->getModel()->where(['ID' => $id]);
        } else {
            $element = $this->getModel()->where(['VALUE_ID' => $id]);
        }
        return $element->update($data);
    }


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
        array $columns = ['*'],
        array $relations = []
    ) {
        if ($scope) {
            $model = $this->getModel()::$scope()->select($columns);
        } else {
            $model = $this->getModel()->select($columns);
        }
        $model = $model->with($relations)->find($id);
        if ($model) {
            $model->makeHidden($this->getHiddenFields());
        }

        return $model;
    }


    /**
     * @param  array         $request
     * @param  string|false  $scope
     * @param  bool          $hasPaginate
     * @param  array         $relations
     * @param  array         $searchFields
     * @param  array         $groupBy
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function index(
        array $request = [],
        $scope = false,
        bool $hasPaginate = false,
        array $relations = [],
        array $searchFields = [],
        array $groupBy = []
    ) {
        $where = [];
        $pageSize = 15;
        $order = ['ID' => 'desc'];
        $select = $request['select'] ?: ['*'];

        if ($scope) {
            if ($scope === 'withSrc') {
                $model = $this->getModel()::$scope();
            } else {
                $model = $this->getModel()::$scope()->select($select);
            }
        } else {
            $model = $this->getModel()->select($select);
        }

        if ($groupBy) {
            $model->groupBy($groupBy);
        }

        if (!empty($request['filter'])) {
            if (isset($request['filter']['search'])) {
                $model->search($searchFields, $request['filter']['search']);
                unset($request['filter']['search']);
            }

            $where = $request['filter'];

            foreach ($request['filter'] as $key => $item) {
                if (is_array($item)) {
                    $model->whereIn($key, $item);

                    unset($where[$key]);
                }
            }
        }

        if (!empty($request['order'])) {
            $order = $request['order'];
        }

        if (!empty($request['per_page'])) {
            $pageSize = $request['per_page'];
        }

        $orderKey = array_key_first($order);
        $model = $model->orderBy($orderKey, $order[$orderKey])->where($where)->with($relations);

        if ($hasPaginate) {
            $paginator = $model->paginate($pageSize);
            $data = $paginator->makeHidden($this->getHiddenFields());
            $paginator->data = $data;

            return $paginator;
        } else {
            return $model->get()->makeHidden(
                $this->getHiddenFields()
            );
        }
    }


    /**
     * @param  int  $id
     *
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        return $this->getModel()->where(['ID' => $id])->delete();
    }

    /**
     * @param  array  $ids
     *
     * @return bool|null
     */
    public function massDelete(array $ids): ?bool
    {
        return $this->getModel()->whereIn('ID', $ids)->delete();
    }


    /**
     * @param  int    $id
     * @param  array  $relation
     *
     * @return mixed
     */
    public function deleteWithRelation(int $id, array $relation)
    {
        $element = $this->getModel()->with($relation)->where(['ID' => $id]);
        foreach ($relation as $item) {
            $element->get()[0]->$item()->delete();
        }

        return $element->delete();
    }

    /**
     * @param  int     $id
     * @param  string  $fileIdColumn
     *
     * @return bool|null
     */
    public function deleteWithFile(int $id, string $fileIdColumn): ?bool
    {
        $element = $this->getModel()->where(['ID' => $id]);
        $getElement = $element->get()[0];
        \CFile::Delete($getElement->$fileIdColumn);

        return $element->delete();
    }


    /**
     * @param  int          $id
     * @param  string|bool  $propertyTable
     * @param  array        $fileRelation
     *
     * @return array
     */
    public function deleteWithProperty(int $id, $propertyTable, array $fileRelation = []): array
    {
        $element = $this->getModel()->where(['ID' => $id]);
        if (!empty($fileRelation)) {
            $elementRelationships = $element->relationships();

            foreach ($elementRelationships as $key => $elementRelationship) {
                if (is_array($elementRelationship) && in_array($key, $fileRelation, true)) {
                    \CFile::Delete($elementRelationship[$key]['ID']);
                }
            }
        }

        $response[] = $element->delete();
        if ($propertyTable !== false) {
            $response[] = $propertyTable::find($id)->delete();
        }

        return $response;
    }


    public function getFields(string $fieldName = ''): array
    {
        $fields = [];
        $tableName = $this->getModel()->getTable();
        $entity = Capsule::table('b_hlblock_entity')->where('TABLE_NAME', $tableName)->first();
        $HLBlockId = $entity->ID;

        if (!empty($HLBlockId)) {
            $CUserTypeManager = new \CUserTypeManager;
            $fields = $CUserTypeManager->GetUserFields('HLBLOCK_'.$HLBlockId, 0, 'ru');
            if (!empty($fieldName)) {
                foreach ($fields as $key => $field) {
                    if ($key === $fieldName) {
                        return $field;
                    }
                }
            }
        }


        return $fields;
    }

    /**
     * @param  \Illuminate\Http\UploadedFile  $file
     *
     * @return false|int|string
     */
    public function createFile(Uploadedfile $file)
    {
        return \CFile::SaveFile(
            [
                "name"      => $file->getClientOriginalName(),
                "size"      => $file->getSize(),
                "tmp_name"  => $file->path(),
                "type"      => $file->getClientMimeType(),
                "MODULE_ID" => "main",
            ],
            ''
        );
    }

}
