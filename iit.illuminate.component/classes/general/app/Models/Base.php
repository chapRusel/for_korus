<?php

namespace IIT\Illuminate\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Base extends Model
{
    /**
     * @param         $query
     * @param  array  $fields
     * @param         $searchTerm
     *
     * @return Builder
     */
    public function scopeSearch($query, array $fields, $searchTerm): Builder
    {
        $query->where($fields[0], 'like', '%'.$searchTerm.'%');
        unset($fields[0]);
        foreach ($fields as $field) {
            $query->orWhere($field, 'like', '%'.$searchTerm.'%');
        }

        return $query;
    }
}
