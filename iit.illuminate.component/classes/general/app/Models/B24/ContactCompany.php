<?php

namespace IIT\Illuminate\App\Models\B24;

use IIT\Illuminate\App\Models\B24\Company\Company;
use IIT\Illuminate\App\Models\B24\Contact\Contact;
use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin Builder
 */
class ContactCompany extends Base
{
    protected $hidden = [
        'SORT',
        'ROLE_ID',
        'IS_PRIMARY',
    ];

    protected $table = 'b_crm_contact_company';

    public $timestamps = false;


    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class, 'ID', 'CONTACT_ID');
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'ID', 'COMPANY_ID');
    }
}
