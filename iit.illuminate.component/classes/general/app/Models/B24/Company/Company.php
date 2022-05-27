<?php

namespace IIT\Illuminate\App\Models\B24\Company;

use IIT\Illuminate\App\Models\B24\Contact\CompanyProperty;
use IIT\Illuminate\App\Models\B24\ContactCompany;
use IIT\Illuminate\App\Models\B24\CrmFieldMulti;
use IIT\Illuminate\App\Models\B24\Deal\Deal;
use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin Builder
 */
class Company extends Base
{
    protected $table = 'b_crm_company';

    public $timestamps = false;


    /**
     * @param  array  $attributes
     *
     * @return \IIT\Illuminate\App\Models\B24\Deal\Deal|\Illuminate\Database\Eloquent\Model|int
     */
    public function create(array $attributes = [])
    {
        $create = (new \CCrmCompany())->Add($attributes);

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
        return (new \CCrmCompany())->Update($this->ID, $attributes);
    }

    /**
     * @return bool|null
     */
    public function delete(): ?bool
    {
        return (new \CCrmCompany())->Delete($this->ID);
    }


    public function fields(): HasMany
    {
        return $this->hasMany(CrmFieldMulti::class, 'ELEMENT_ID', 'ID');
    }

    public function property(): HasOne
    {
        return $this->hasOne(CompanyProperty::class, 'VALUE_ID', 'ID');
    }

    public function deal(): HasMany
    {
        return $this->hasMany(Deal::class, 'COMPANY_ID', 'ID');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(ContactCompany::class, 'COMPANY_ID', 'ID')
            ->with('company');
    }

    public function scopeRelationships($query): Builder
    {
        return $query->with('fields', 'property', 'deal', 'contacts');
    }
}
