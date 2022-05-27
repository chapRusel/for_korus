<?php

namespace IIT\Notify\Src\Classes\Managers\Notify;

use IIT\Notify\Src\Classes\Senders\Sender;
use IIT\Notify\Src\Classes\Senders\SMSSender;

class SMSNotifyManager extends NotifyManager
{

    public function getSender(): Sender
    {
        return new SMSSender($this->arNotify);
    }

    public function setSent()
    {
        $this->notifyListRepository->update($this->arNotify['ID'], ['UF_SENT_IN_SMS' => 1]);
    }
}