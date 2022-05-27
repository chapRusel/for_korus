<?php

namespace IIT\Notify\Src\Classes\Senders;

use IIT\Notify\App\WebSockets\Base;

class BrowserSender extends Sender
{
    public function send(): bool
    {
        $ws = new Base($this->fields['UF_USER']);
        return $ws->sendMessage($this->fields['UF_TITLE'], $this->fields['ID']);
    }
}