<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

class IITCompanyReportKPIComponent extends CBitrixComponent
{
    const SEF_DEFAULT_TEMPLATES = array(
        'user' => 'user/',
    );

    /**
     * Component URL handeler
     */
    public function executeComponent()
    {

        if (empty($this->arParams['SEF_MODE']) || $this->arParams['SEF_MODE'] != 'Y') {
            ShowError('Режим ЧПУ должен быть включен.');
            return;
        }

        if (empty($this->arParams['SEF_FOLDER'])) {
            ShowError('Не указан каталог ЧПУ.');
            return;
        }

        if (!is_array($this->arParams['SEF_URL_TEMPLATES'])) {
            $this->arParams['SEF_URL_TEMPLATES'] = array();
        }

        $sefTemplates = array_merge(self::SEF_DEFAULT_TEMPLATES, $this->arParams['SEF_URL_TEMPLATES']);

        $page = CComponentEngine::parseComponentPath(
            $this->arParams['SEF_FOLDER'],
            $sefTemplates,
            $arVariables
        );

        if (empty($page)) {
            $page = 'list';
        }

        $this->arResult = array(
            'SEF_FOLDER' => $this->arParams['SEF_FOLDER'],
            'SEF_URL_TEMPLATES' => $sefTemplates,
            'VARIABLES' => $arVariables,
        );

        $this->includeComponentTemplate($page);
    }
}
