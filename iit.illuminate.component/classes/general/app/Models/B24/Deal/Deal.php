<?php

namespace IIT\Illuminate\App\Models\B24\Deal;

use IIT\Illuminate\App\Models\B24\Company\Company;
use IIT\Illuminate\App\Models\B24\Contact\DealProperty;
use IIT\Illuminate\App\Models\B24\CrmFieldMulti;
use IIT\Illuminate\App\Models\B24\DealContact;
use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin Builder
 */
class Deal extends Base
{
    protected $table = 'b_crm_deal';

    public $timestamps = false;


    /**
     * @param  array  $attributes
     *
     * @return \IIT\Illuminate\App\Models\B24\Deal\Deal|\Illuminate\Database\Eloquent\Model|int
     */
    public function create(array $attributes = [])
    {
        $create = (new \CCrmDeal())->Add($attributes);

        if ( $create ) {
            return $create;
        } else {
            return $create->LAST_ERROR;
        }
    }

    /**
     * @param  array  $attributes
     * @param  array  $options
     *
     * @return bool
     */
    public function update(array $attributes = [], array $options = []): bool
    {
        return (new \CCrmDeal())->Update($this->ID, $attributes);
    }

    /**
     * @return bool|null
     */
    public function delete(): ?bool
    {
        return (new \CCrmDeal())->Delete($this->ID);
    }


    public function fields(): HasMany
    {
        return $this->hasMany(CrmFieldMulti::class, 'ELEMENT_ID', 'ID');
    }

    public function property(): HasOne
    {
        return $this->hasOne(DealProperty::class, 'VALUE_ID', 'ID');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(DealContact::class, 'DEAL_ID', 'ID')
            ->with('contact');
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'ID', 'COMPANY_ID');
    }

    public function scopeRelationships($query): Builder
    {
        return $query->with('fields', 'property', 'contacts', 'company');
    }
}
