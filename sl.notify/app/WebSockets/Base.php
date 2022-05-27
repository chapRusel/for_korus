<?php

namespace IIT\Notify\App\WebSockets;

/**
 * Class Base
 * Common class for work with web socket
 *
 * @package IIT\Notify\App\WebSockets
 */
class Base
{
    private array $config;

    public function __construct($userId)
    {
        $this->config = Config::getForUser($userId);
    }

    public function sendMessage($notifyTitle, $notifyId)
    {
        if ($this->checkOnlineChannel()) {
            return \CPullStack::AddByChannel(
                $this->config['channelId'],
                [
                    'module_id' => 'sl.notify',
                    'command'   => 'newMessage',
                    'params'    => [
                        'title'  => $notifyTitle,
                        'id' => $notifyId,
                    ],
                ]
            );
        } else {
            return false;
        }
    }

    private function checkOnlineChannel()
    {
        $currentChannelId = preg_replace('/\.\w+/', '', $this->config['channelId']);
        $onlineChannels = \CPullChannel::GetOnlineChannels([$currentChannelId]);

        return $onlineChannels[$currentChannelId];
    }
}