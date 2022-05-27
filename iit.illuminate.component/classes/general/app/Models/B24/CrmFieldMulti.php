<?php

namespace IIT\Illuminate\App\Models\B24;

use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class CrmFieldMulti extends Base
{
    protected $hidden = [
        'ID',
        'ELEMENT_ID',
    ];

    protected $table = 'b_crm_field_multi';

    public $timestamps = false;

}
