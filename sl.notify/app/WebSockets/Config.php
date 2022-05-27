<?php

namespace IIT\Notify\App\WebSockets;

use Bitrix\Main\Loader;

/**
 * Class Config
 * Use for getting web socket channels for users
 *
 * @package IIT\Notify\App\WebSockets
 */
class Config
{
    /**
     * @param int $userId
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     */
    public static function getForUser(int $userId): array
    {
        $commonConfig = \Bitrix\Pull\Config::get();
        $userConfig   = \CPullChannel::Get($userId);
        $userChannel  = \CPullChannel::SignChannel($userConfig['CHANNEL_ID']);

        return [
            'server'    => $commonConfig['SERVER']['WEBSOCKET'],
            'clientId'  => $commonConfig['CLIENT_ID'],
            'channelId' => $userChannel,
        ];
    }

    public static function getCommon()
    {
        Loader::includeModule('pull');

        $arConfig = \Bitrix\Pull\Config::get();

        return [
            'server'    => $arConfig['SERVER']['WEBSOCKET'],
            'clientId'  => $arConfig['CLIENT_ID'],
            'channelId' => $arConfig['CHANNELS']['SHARED']['ID'],
        ];
    }
}