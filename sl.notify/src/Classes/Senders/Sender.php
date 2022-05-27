<?php

namespace IIT\Notify\Src\Classes\Senders;

abstract class Sender
{
    protected array $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    abstract public function send(): bool;
}