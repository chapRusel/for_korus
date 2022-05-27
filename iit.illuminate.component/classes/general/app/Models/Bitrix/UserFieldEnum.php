<?php

namespace IIT\Illuminate\App\Models\B24;

use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class UserFieldEnum extends Base
{
    protected $table = 'b_user_field_enum';
    public $timestamps = false;

}
