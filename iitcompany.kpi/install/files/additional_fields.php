<?php
return [
    [
        'FIELDS' => [
            'CODE' => 'UF_SELLER_ROLE',
            'TYPE' => 'employee',
            'NAME' => 'Продавец',
            'SORT' => 10,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_MANAGER_ROLE',
            'TYPE' => 'employee',
            'NAME' => 'Менеджер проекта',
            'SORT' => 20,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_PRODUCTION_ROLE',
            'TYPE' => 'employee',
            'NAME' => 'Управляющий производством',
            'SORT' => 30,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_DEAL_SUMM',
            'TYPE' => 'double',
            'NAME' => 'Сумма сделки',
            'SORT' => 40,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_INTERACTION_FEATURES',
            'TYPE' => 'string',
            'NAME' => 'Особенности взаимодействия',
            'SORT' => 50,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_SENT_FOR_CALCULATION',
            'TYPE' => 'boolean',
            'NAME' => 'ТЗ отправлено на расчет сметчику',
            'SORT' => 60,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_PROJECT_SUMM',
            'TYPE' => 'double',
            'NAME' => 'Сумма на которую рассчитан проект',
            'SORT' => 70,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_SPECIFICATION_OF_PRODUCTS_CREATE',
            'TYPE' => 'boolean',
            'NAME' => 'Создана спецификация изделий и отделки к ним',
            'SORT' => 80,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_PRODUCT_CARD_IS_FILLED_AND_FILES_UPLOADED',
            'TYPE' => 'boolean',
            'NAME' => 'Заполнена карточка изделия и прикреплены файлы',
            'SORT' => 90,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_TRANSFERRED_TO_MP',
            'TYPE' => 'boolean',
            'NAME' => 'Сделка передана МП',
            'SORT' => 100,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_CONTRACT_IS_APPROVED',
            'TYPE' => 'boolean',
            'NAME' => 'Договор согласован',
            'SORT' => 105,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_CONTRACT',
            'TYPE' => 'file',
            'NAME' => 'Договор',
            'SORT' => 110,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',

        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_BASIC_TERMS_OF_CONTRACT',
            'TYPE' => 'string',
            'NAME' => 'Основные условия договора',
            'SORT' => 120,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_SUMM_PROJECT_WAS_SOLD',
            'TYPE' => 'double',
            'NAME' => 'Сумма на которую продан проект',
            'SORT' => 130,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_CONTRACT_SCAN',
            'TYPE' => 'file',
            'NAME' => 'Договор скан',
            'SORT' => 140,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_INVOICE',
            'TYPE' => 'file',
            'NAME' => 'Счет',
            'SORT' => 150,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_ADVANCE_PAYMENT_RECEIVED',
            'TYPE' => 'boolean',
            'NAME' => 'Аванс получен',
            'SORT' => 160,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_PROJECT_TRANSFERRED_TO_MP',
            'TYPE' => 'boolean',
            'NAME' => 'Проект передан МП',
            'SORT' => 170,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_TASKS_FOR_APPROVAL_IS_SET',
            'TYPE' => 'boolean',
            'NAME' => 'Поставлены задачи на согласование',
            'SORT' => 180,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_TASKS_FOR_DESIGN_PRODUCTS_IS_SET',
            'TYPE' => 'boolean',
            'NAME' => 'Поставлены задачи на проектирование изделий',
            'SORT' => 190,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_SKETCHES_CD_IS_APPROVED',
            'TYPE' => 'boolean',
            'NAME' => 'Согласованы эскизы КД',
            'SORT' => 200,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_RECONCILIATION_WITH_CUSTOMER_IS_CREATED',
            'TYPE' => 'boolean',
            'NAME' => 'Создана сверка с Заказчиком',
            'SORT' => 210,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_CALCULATE_ECONOMY_BY_CD',
            'TYPE' => 'boolean',
            'NAME' => 'Расчет экономики по КД',
            'SORT' => 220,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_CD_UPLOADED_TO_PROJECT_FOLDER',
            'TYPE' => 'boolean',
            'NAME' => 'КД загружена в папку проекта',
            'SORT' => 230,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_FEATURES_PROJECT_IS_FILLED',
            'TYPE' => 'boolean',
            'NAME' => 'Особенности проекта заполнены',
            'SORT' => 240,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_ASKD_WAS_MADE_AND_SIGN',
            'TYPE' => 'boolean',
            'NAME' => 'Сделан и подписан АСКД с Заказчиком',
            'SORT' => 250,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_ASKD_SCAN',
            'TYPE' => 'file',
            'NAME' => 'Скан АСКД',
            'SORT' => 255,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_ANALYSIS_PRODUCT_BY_MATERIALS',
            'TYPE' => 'boolean',
            'NAME' => 'Разбор изделия по материалам',
            'SORT' => 260,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_MATERIALS_PURCHASED',
            'TYPE' => 'boolean',
            'NAME' => 'Материалы закуплены',
            'SORT' => 265,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_REPORT_ON_WORK_HAS_MADE',
            'TYPE' => 'boolean',
            'NAME' => 'Сделан отчет о выполненной работе',
            'SORT' => 270,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_INSTALLER_WAS_FOUND',
            'TYPE' => 'boolean',
            'NAME' => 'Найдены монтажники и заполнены в карточке проекта',
            'SORT' => 280,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_SUMM_OF_PRODUCT_SHIPPED',
            'TYPE' => 'double',
            'NAME' => 'Сумма отгруженной продукции',
            'SORT' => 290,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_UPD_WAS_SIGNED',
            'TYPE' => 'boolean',
            'NAME' => 'Подписан УПД по факту доставки',
            'SORT' => 300,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_RECONCILIATION_WITH_INSTALLERS',
            'TYPE' => 'boolean',
            'NAME' => 'Сверка с Монтажниками/Расчет',
            'SORT' => 310,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_APP_WAS_SIGNED_UPON_COMPLETION_OF_THE_PROJECT',
            'TYPE' => 'boolean',
            'NAME' => 'Подписан АПП по факту сдачи проекта',
            'SORT' => 320,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_SALE_DOCUMENTS_WAS_UPLOADED',
            'TYPE' => 'boolean',
            'NAME' => 'Документы по продаже загружены в папку',
            'SORT' => 330,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_ALL_DOCUMENTS_WAS_UPLOADED',
            'TYPE' => 'boolean',
            'NAME' => 'Загружены все документы',
            'SORT' => 340,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_DOCUMENTS_WAS_UPLOADED_ON_TIME',
            'TYPE' => 'boolean',
            'NAME' => 'Документы загружены вовремя',
            'SORT' => 350,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
    [
        'FIELDS' => [
            'CODE' => 'UF_OS_RECEIVED',
            'TYPE' => 'boolean',
            'NAME' => 'Получена ОС/Отзыв',
            'SORT' => 360,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
        ],
        'ENTITY' => 'CRM_DEAL'
    ],
];