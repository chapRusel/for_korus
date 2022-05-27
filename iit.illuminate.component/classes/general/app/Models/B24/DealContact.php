<?php

namespace IIT\Illuminate\App\Models\B24;

use IIT\Illuminate\App\Models\B24\Contact\Contact;
use IIT\Illuminate\App\Models\B24\Deal\Deal;
use IIT\Illuminate\App\Models\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin Builder
 */
class DealContact extends Base
{
    protected $hidden = [
        'SORT',
        'ROLE_ID',
        'IS_PRIMARY',
    ];

    protected $table = 'b_crm_deal_contact';

    public $timestamps = false;


    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class, 'ID', 'CONTACT_ID');
    }

    public function deal(): HasOne
    {
        return $this->hasOne(Deal::class, 'ID', 'DEAL_ID');
    }
}
