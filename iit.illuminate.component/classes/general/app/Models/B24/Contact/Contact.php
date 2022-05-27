<?php

namespace IIT\Illuminate\App\Models\B24\Contact;

use IIT\Illuminate\App\Models\B24\ContactCompany;
use IIT\Illuminate\App\Models\B24\CrmFieldMulti;
use IIT\Illuminate\App\Models\B24\DealContact;
use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Bitrix\Crm\Entity\Contact as EntityContact;


/**
 * @mixin Builder
 */
class Contact extends Base
{
    protected $table = 'b_crm_contact';
    public $timestamps = false;


    /**
     * @param  array  $attributes
     *
     * @return false|int
     */
    public function create(array $attributes = [])
    {
        $entityContact = EntityContact::getInstance();
        $create = $entityContact->create($attributes);

        if ($create) {
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
    public function update(array $attributes = [], array $options = [])
    {
        return (new \CCrmContact())->Update($this->ID, $attributes);
    }

    /**
     * @param  int  $id
     *
     * @return bool|null
     */
    public function delete(int $id)
    {
        return (new \CCrmContact())->Delete($this->ID);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(CrmFieldMulti::class, 'ELEMENT_ID', 'ID');
    }

    public function property(): HasOne
    {
        return $this->hasOne(ContactProperty::class, 'VALUE_ID', 'ID');
    }

    public function deals(): HasMany
    {
        return $this->hasMany(DealContact::class, 'CONTACT_ID', 'ID');
    }

    public function companies(): HasMany
    {
        return $this->hasMany(ContactCompany::class, 'CONTACT_ID', 'ID')
            ->with('company');
    }

    public function scopeRelationships($query): Builder
    {
        return $query->with('fields', 'property', 'deals', 'companies');
    }

}
