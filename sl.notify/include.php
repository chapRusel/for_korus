<?php
use Bitrix\Main\Loader;
use Bitrix\Main\UI;

Loader::includeModule('sl.entity');
Loader::includeModule('highloadblock');

if ( Loader::includeModule('iit.illuminate.component') ) {
    require_once 'vendor/autoload.php';

    $obConnection = new \IIT\Illuminate\Eloquent\Database\Connection();
    $obConnection->addConnection();
}

Loader::registerAutoLoadClasses(
    "sl.notify",
    []
);