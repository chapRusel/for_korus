<?php
use Bitrix\Main\Loader;
use Bitrix\Main\UI;

if ( file_exists(__DIR__ . '/vendor/autoload.php') ) {
    require_once 'vendor/autoload.php';
}

Loader::registerAutoLoadClasses(
    "sl.content",
    []
);