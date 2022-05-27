<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent(
    'iitcompany.kpi:report',
    '',
    [
        'SEF_MODE'          => 'Y',
        'SEF_FOLDER'        => '/kpi/',
        'SEF_URL_TEMPLATES' => [
            'user' => 'user/',
        ]
    ],
    false
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
