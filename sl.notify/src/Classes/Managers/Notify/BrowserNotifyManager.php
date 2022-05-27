<?php

namespace IIT\Notify\Src\Classes\Managers\Notify;

use IIT\Notify\Src\Classes\Senders\BrowserSender;
use IIT\Notify\Src\Classes\Senders\Sender;

class BrowserNotifyManager extends NotifyManager
{

    public function getSender(): Sender
    {
        return new BrowserSender($this->arNotify);
    }

    public function setSent()
    {
        $this->notifyListRepository->update($this->arNotify['ID'], ['UF_SENT_IN_BROWSER' => 1]);
    }
}