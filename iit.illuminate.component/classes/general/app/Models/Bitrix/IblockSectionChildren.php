<?php

namespace IIT\Illuminate\App\Models\Bitrix;

use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;

/**
 * Class IblockSection
 *
 * @package IIT\Illuminate\App\Models\Bitrix
 */
class IblockSectionChildren extends Base
{
    protected $table = 'b_iblock_section';
    public $timestamps = false;

    protected $hidden = [
        'IBLOCK_SECTION_ID'
    ];

    public function parent(): HasOne
    {
        return $this->hasOne(__CLASS__, 'ID', 'IBLOCK_SECTION_ID')
            ->select(['ID', 'NAME', 'IBLOCK_SECTION_ID']);
    }

    public function scopeHasParent(Builder $query): Builder
    {
        return $query->whereNotNull('IBLOCK_SECTION_ID');
    }
}
