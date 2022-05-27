<?php

namespace IIT\Illuminate\App\Models\Bitrix;

use CUser;
use IIT\Illuminate\App\Models\Base;

/**
 * Class User
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @package IIT\Illuminate\App\Models\Bitrix
 */
class User extends Base
{
    protected $table = 'b_user';
    public $timestamps = false;


    /**
     * @param  array  $attributes
     *
     * @return false|\IIT\Illuminate\App\Models\Bitrix\User|\Illuminate\Database\Eloquent\Model|int|mixed|string
     */
    public function create(array $attributes = [])
    {
        $user = new CUser();
        $ID = $user->Add($attributes);
        if ((int)$ID > 0) {
            return $ID;
        }

        return $user->LAST_ERROR;
    }

    /**
     * @param  array  $attributes
     * @param  array  $options
     *
     * @return bool|string
     */
    public function update(array $attributes = [], array $options = [])
    {
        $user = new CUser();
        if ($user->Update($this->ID, $attributes)) {
            return true;
        }

        return $user->LAST_ERROR;
    }

    /**
     *
     * @return bool|null
     */
    public function delete(): ?bool
    {
        return CUser::Delete($this->ID);
    }
}
