<?php

namespace IIT\Illuminate\App\Models\Bitrix;

use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class IblockSection
 *
 * @package IIT\Illuminate\App\Models\Bitrix
 */
class IblockSection extends Base
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

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'IBLOCK_SECTION_ID', 'ID')
            ->select(['ID', 'NAME', 'IBLOCK_SECTION_ID']);
    }


    public function scopeWithChildren(Builder $query): Builder
    {
        return $query
            ->whereNull('IBLOCK_SECTION_ID')
            ->whereHas('children', function ($query) {
                $query->whereNotNull('IBLOCK_SECTION_ID');
            });
    }

    public function scopeWithoutChildren(Builder $query): Builder
    {
        return $query
            ->where('DEPTH_LEVEL', '=', 1)
            ->whereNull('IBLOCK_SECTION_ID')
            ->doesntHave('children');
    }
}
