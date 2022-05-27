<?php

namespace IIT\Notify\Src\Classes\Managers\Notify;

use IIT\Notify\Src\Classes\Senders\EmailSender;
use IIT\Notify\Src\Classes\Senders\Sender;

class EmailNotifyManager extends NotifyManager
{

    public function getSender(): Sender
    {
        return new EmailSender($this->arNotify);
    }

    public function setSent()
    {
        $this->notifyListRepository->update($this->arNotify['ID'], ['UF_SENT_IN_EMAIL' => 1]);
    }
}