<?php

namespace IIT\Notify\App\Models\Notify;

use IIT\Illuminate\App\Models\Base;

class NotifyList extends Base
{
    protected $table = 'sl_notify_list';
    public $timestamps = false;
    protected $fillable = [
        'UF_SENT',
        'UF_TITLE',
    ];
}