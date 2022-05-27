<?php

namespace IIT\Illuminate\App\Models\B24;

use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class File extends Base
{
    protected $table = 'b_file';

    public $timestamps = false;


    public function scopeWithSrc($query)
    {
        return $query->selectRaw(
            ''.$this->table.'.ID,ORIGINAL_NAME, CONCAT("/upload/", '.$this->table.'.SUBDIR, "/", '.$this->table.'.FILE_NAME) as SRC'
        );
    }
}

