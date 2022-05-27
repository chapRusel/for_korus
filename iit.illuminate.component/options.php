<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php');
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php');

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use IIT\Entity\Module\Option;
use IIT\Illuminate\ModuleSettings;

Loc::loadMessages(__FILE__);
Loc::loadMessages($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/options.php');

$moduleID = 'iit.illuminate.component';
global $APPLICATION;

Loader::includeModule($moduleID);
\CJSCore::Init(['jquery2']);


$RIGHT = $APPLICATION->GetGroupRight($moduleID);


$APPLICATION->SetAdditionalCSS('/local/modules/'.$moduleID.'/public/css/buttons.css');
$APPLICATION->SetAdditionalCSS('/local/modules/'.$moduleID.'/public/css/forms.css');
$APPLICATION->SetAdditionalCSS('/local/modules/'.$moduleID.'/public/css/github-markdown.css');
\Bitrix\Main\Page\Asset::getInstance()->addJs('/local/modules/'.$moduleID.'/public/js/optionsForm.js');

$arSettings = ModuleSettings::get();

$eloquentSettings = json_decode($arSettings['eloquent'], false);
$validationSettings = json_decode($arSettings['validation'], false);
$operating_modeSettings = json_decode($arSettings['operating_mode'], false);

if ($RIGHT >= "R") {
    $showRightsTab = false;

    $arTabs = [
        [
            "DIV"       => "edit1",
            "TAB"       => 'Module description',
            "ICON"      => "settings",
            "PAGE_TYPE" => "module_rules",
            "OPTIONS"   => [],
        ],
        [
            "DIV"       => "edit2",
            "TAB"       => 'Eloquent ORM',
            "ICON"      => "settings",
            "PAGE_TYPE" => "module_rules",
            "OPTIONS"   => [],
        ],
        [
            "DIV"       => "edit3",
            "TAB"       => 'Illuminate Validation',
            "ICON"      => "settings",
            "PAGE_TYPE" => "module_rules",
            "OPTIONS"   => [],
        ],
        [
            "DIV"       => "edit4",
            "TAB"       => 'Operating mode',
            "ICON"      => "settings",
            "PAGE_TYPE" => "module_rules",
            "OPTIONS"   => [],
        ],
    ];

    $arGroups = [
        'Eloquent'       => [
            'TITLE' => 'Specify the data to connect to the database (by default, the data is taken from settings.php)',
            'TAB'   => 1
        ],
        'Validation'     => [
            'TITLE' => 'Settings',
            'TAB'   => 2
        ],
        'Operating mode' => [
            'TITLE' => 'The operation mode allows you to switch the module from development to production. In production mode, exceptions are not displayed and you can return custom responses when checking the current mode',
            'TAB'   => 3
        ],
    ];


    $arOptions = [
        'ELOQUENT_DRIVER'       => [
            'GROUP'   => 'Eloquent',
            'TITLE'   => 'Driver',
            'DEFAULT' => $eloquentSettings->ELOQUENT_DRIVER,
            'VALUE'   => $eloquentSettings->ELOQUENT_DRIVER,
            'SORT'    => 1
        ],
        'ELOQUENT_HOST'         => [
            'GROUP'   => 'Eloquent',
            'TITLE'   => 'Host',
            'DEFAULT' => $eloquentSettings->ELOQUENT_HOST,
            'VALUE'   => $eloquentSettings->ELOQUENT_HOST,
            'SORT'    => 2
        ],
        'ELOQUENT_DB'           => [
            'GROUP'   => 'Eloquent',
            'TITLE'   => 'Database',
            'DEFAULT' => $eloquentSettings->ELOQUENT_DB,
            'VALUE'   => $eloquentSettings->ELOQUENT_DB,
            'SORT'    => 3
        ],
        'ELOQUENT_USR_NAME'     => [
            'GROUP'   => 'Eloquent',
            'TITLE'   => 'User name',
            'DEFAULT' => $eloquentSettings->ELOQUENT_USR_NAME,
            'VALUE'   => $eloquentSettings->ELOQUENT_USR_NAME,
            'SORT'    => 4
        ],
        'ELOQUENT_USR_PASSWORD' => [
            'GROUP'   => 'Eloquent',
            'TITLE'   => 'User password',
            'DEFAULT' => $eloquentSettings->ELOQUENT_USR_PASSWORD,
            'VALUE'   => $eloquentSettings->ELOQUENT_USR_PASSWORD,
            'SORT'    => 5
        ],
        'ELOQUENT_CHARSET'      => [
            'GROUP'   => 'Eloquent',
            'TITLE'   => 'Charset',
            'DEFAULT' => $eloquentSettings->ELOQUENT_CHARSET,
            'VALUE'   => $eloquentSettings->ELOQUENT_CHARSET,
            'SORT'    => 6
        ],
        'ELOQUENT_COLLATION'    => [
            'GROUP'   => 'Eloquent',
            'TITLE'   => 'Collation',
            'DEFAULT' => $eloquentSettings->ELOQUENT_COLLATION,
            'VALUE'   => $eloquentSettings->ELOQUENT_COLLATION,
            'SORT'    => 7
        ],
        'ELOQUENT_PREFIX'       => [
            'GROUP'   => 'Eloquent',
            'TITLE'   => 'Prefix',
            'DEFAULT' => $eloquentSettings->ELOQUENT_PREFIX,
            'VALUE'   => $eloquentSettings->ELOQUENT_PREFIX,
            'SORT'    => 8
        ],

        'OPERATING_MODE_PRODUCTION' => [
            'GROUP'   => 'Operating mode',
            'TITLE'   => 'Production mode',
            'TYPE'    => 'CHECKBOX',
            'SORT'    => 1,
            'DEFAULT' => $operating_modeSettings->OPERATING_MODE_PRODUCTION,
            'VALUE'   => $operating_modeSettings->OPERATING_MODE_PRODUCTION,
        ],

        'VALIDATION_DB_SETTINGS'    => [
            'GROUP'   => 'Validation',
            'TITLE'   => 'Use the connection settings from Eloquent',
            'TYPE'    => 'CHECKBOX',
            'DEFAULT' => $validationSettings->VALIDATION_DB_SETTINGS,
            'VALUE'   => $validationSettings->VALIDATION_DB_SETTINGS,
            'SORT'    => 1
        ],
        'VALIDATION_LANG_FILE_PATH' => [
            'GROUP'   => 'Validation',
            'TITLE'   => 'Custom Lang file dir path',
            'DEFAULT' => $validationSettings->VALIDATION_LANG_FILE_PATH,
            'VALUE'   => $validationSettings->VALIDATION_LANG_FILE_PATH,
            'SORT'    => 1
        ],
        'VALIDATION_LANG'           => [
            'GROUP'   => 'Validation',
            'TITLE'   => 'Use Russian validation',
            'TYPE'    => 'CHECKBOX',
            'DEFAULT' => $validationSettings->VALIDATION_LANG,
            'VALUE'   => $validationSettings->VALIDATION_LANG,
            'SORT'    => 1
        ]
    ];

    if ($validationSettings->VALIDATION_DB_SETTINGS === 'N') {
        $arOptions['VALIDATION_ALT_DRIVER'] = [
            'GROUP' => 'Validation',
            'TITLE' => 'Driver',
            'SORT'  => 1,
            'VALUE' => $validationSettings->VALIDATION_ALT_DRIVER,
        ];
        $arOptions['VALIDATION_ALT_HOST'] = [
            'GROUP' => 'Validation',
            'TITLE' => 'Host',
            'SORT'  => 2,
            'VALUE' => $validationSettings->VALIDATION_ALT_HOST,
        ];
        $arOptions['VALIDATION_ALT_DB'] = [
            'GROUP' => 'Validation',
            'TITLE' => 'Database',
            'SORT'  => 3,
            'VALUE' => $validationSettings->VALIDATION_ALT_DB,
        ];
        $arOptions['VALIDATION_ALT_NAME'] = [
            'GROUP' => 'Validation',
            'TITLE' => 'User name',
            'SORT'  => 4,
            'VALUE' => $validationSettings->VALIDATION_ALT_NAME,
        ];
        $arOptions['VALIDATION_ALT_PASSWORD'] = [
            'GROUP' => 'Validation',
            'TITLE' => 'User password',
            'SORT'  => 5,
            'VALUE' => $validationSettings->VALIDATION_ALT_PASSWORD,
        ];
        $arOptions['VALIDATION_ALT_CHARSET'] = [
            'GROUP' => 'Validation',
            'TITLE' => 'Charset',
            'SORT'  => 6,
            'VALUE' => $validationSettings->VALIDATION_ALT_CHARSET,
        ];
        $arOptions['VALIDATION_ALT_COLLATION'] = [
            'GROUP' => 'Validation',
            'TITLE' => 'Collation',
            'SORT'  => 6,
            'VALUE' => $validationSettings->VALIDATION_ALT_COLLATION,
        ];
        $arOptions['VALIDATION_ALT_PREFIX'] = [
            'GROUP' => 'Validation',
            'TITLE' => 'Prefix',
            'SORT'  => 7,
            'VALUE' => $validationSettings->VALIDATION_ALT_PREFIX,
        ];
    }

    $opt = new Option($moduleID, $arTabs, $arGroups, $arOptions, $showRightsTab);
    $opt->render();
}


if ($_REQUEST['autosave_id']) {
    if (empty($_REQUEST['OPERATING_MODE_PRODUCTION'])) {
        $_REQUEST['OPERATING_MODE_PRODUCTION'] = 'N';
    }
    if (empty($_REQUEST['VALIDATION_DB_SETTINGS'])) {
        $_REQUEST['VALIDATION_DB_SETTINGS'] = 'N';
    }
    if (empty($_REQUEST['VALIDATION_LANG'])) {
        $_REQUEST['VALIDATION_LANG'] = 'N';
    }


    ModuleSettings::update($_REQUEST);
    LocalRedirect('/bitrix/admin/settings.php?mid=iit.illuminate.component');
}
