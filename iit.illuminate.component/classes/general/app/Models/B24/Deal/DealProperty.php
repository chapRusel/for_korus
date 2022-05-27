<?php

namespace IIT\Illuminate\App\Models\B24\Contact;

use IIT\Illuminate\App\Models\Base;

class DealProperty extends Base
{
    protected $table = 'b_uts_crm_deal';
    protected $hidden = ['VALUE_ID'];
    public $timestamps = false;
}
