<?php

namespace IIT\Notify\Src\Classes\Managers\Notify;

use IIT\Notify\App\Repositories\Notify\NotifyListRepository;
use IIT\Notify\Src\Classes\Senders\Sender;

abstract class NotifyManager
{
    const BROWSER_SEND = 'browser';
    const SITE_SEND = 'site';
    const EMAIL_SEND = 'email';
    const SMS_SEND = 'sms';

    protected NotifyListRepository $notifyListRepository;
    protected array $arNotify;

    public function __construct(array $arNotify)
    {
        $this->arNotify = $arNotify;
        $this->notifyListRepository = new NotifyListRepository();
    }

    abstract public function getSender(): Sender;
    abstract public function setSent();
}