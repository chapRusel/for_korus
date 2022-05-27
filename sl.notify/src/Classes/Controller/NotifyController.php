<?php

namespace IIT\Notify\Src\Classes\Controller;

use IIT\Illuminate\App\Repositories\EloquentRepository;
use IIT\Notify\App\Repositories\Notify\NotifyListRepository;
use IIT\Notify\App\Repositories\Notify\SettingsRepository;
use IIT\Notify\Src\Classes\Managers\Notify\BrowserNotifyManager;
use IIT\Notify\Src\Classes\Managers\Notify\EmailNotifyManager;
use IIT\Notify\Src\Classes\Managers\Notify\NotifyManager;
use IIT\Notify\Src\Classes\Managers\Notify\SiteNotifyManager;
use IIT\Notify\Src\Classes\Managers\Notify\SMSNotifyManager;

/**
 * Class NotifyController
 * Searching NotifyManager and using him for sending notify
 *
 * @package IIT\Notify\Src\Classes\Controller
 */
class NotifyController
{
    private array $arNotify;
    private EloquentRepository $settingsRepository;
    private EloquentRepository $listRepository;

    public function __construct(array $arNotify = [])
    {
        $this->arNotify = $arNotify;
        $this->settingsRepository = new SettingsRepository();
        $this->listRepository = new NotifyListRepository();
    }

    /**
     * @return void
     */
    public function send()
    {
        $userSettings = $this->settingsRepository
            ->getUserSettingsForEntity($this->arNotify['UF_USER'], $this->arNotify['UF_ENTITY']);

        foreach ($userSettings as $setting) {
            $sendType = $this->settingsRepository
                ->getTypeXmlId($setting['UF_SEND_TYPE']);
            $notifyManager = $this->getNotifyManager($sendType);

            if ($notifyManager) {
                $result = $notifyManager->getSender()->send();

                if ($result) {
                    $notifyManager->setSent();
                }
            }
        }
    }

    /**
     * Send unsent notifies for user
     *
     * @param int $userId
     * @return void
     */
    public function sendUnsentNotificationsToWebsocket(int $userId)
    {
        $arNotifies = $this->listRepository->getUnsentForWebsocket($userId);

        foreach ($arNotifies as $notify) {
            $this->arNotify = $notify;
            $this->send();
        }
    }

    /**
     * @param string $sendType
     * @return mixed
     */
    private function getNotifyManager(string $sendType)
    {
        $manager = null;

        switch ($sendType) {
            case NotifyManager::SITE_SEND:
                if ($this->arNotify['UF_SENT_IN_SITE'] === 0) {
                    $manager = new SiteNotifyManager($this->arNotify);
                }

                break;
            case NotifyManager::BROWSER_SEND:
                if ($this->arNotify['UF_SENT_IN_BROWSER'] === 0) {
                    $manager = new BrowserNotifyManager($this->arNotify);
                }

                break;
            case NotifyManager::EMAIL_SEND:
                if ($this->arNotify['UF_SENT_IN_EMAIL'] === 0) {
                    $manager = new EmailNotifyManager($this->arNotify);
                }

                break;
            case NotifyManager::SMS_SEND:
                if ($this->arNotify['UF_SENT_IN_SMS'] === 0) {
                    $manager = new SMSNotifyManager($this->arNotify);
                }

                break;
        }

        return $manager;
    }
}