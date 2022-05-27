<?php

namespace IITCompany\KPI\Controller;

class BaseController
{
    const MODULE_ID = 'iitcompany.kpi';
    const FIELD_ENTITY = 'CRM_DEAL';
    const ROLES = ['UF_SELLER_ROLE', 'UF_MANAGER_ROLE', 'UF_PRODUCTION_ROLE'];
    const FIRST_FIELD_STATUS = 'UF_DEAL_SUMM';
    const SELLER_ROLE_ID = 1;
    const MANAGER_ROLE_ID = 2;
    const PRODUCTION_ROLE_ID = 3;
    const RELATION_ROLES = [
        'SELLER' => [
            'C7:NEW',
            'C7:1',
            'C7:2',
            'C7:6',
            'C7:7',
            'C7:8',
            'C7:10',
            'C7:PROJECT_FEATURES',
            'C7:20',
        ],
        'MANAGER' => [
            'C7:DESIGN_TASKS',
            'C7:APPROVE_TASKS',
            'C7:11',
            'C7:12',
            'C7:13',
            'C7:15',
            'C7:17',
            'C7:18',
            'C7:19',
            'C7:DOWNLOAD_DOCS',
            'C7:WON',
        ],
        'PRODUCTION' => [
            'C7:PURCHASES_WORKING',
            'C7:14',
            'C7:16',
        ]
    ];
    const STAGES = [
        'C7:NEW' => ['UF_DEAL_SUMM'],
        'C7:1' => ['UF_INTERACTION_FEATURES'],
        'C7:2' => [
            'UF_SENT_FOR_CALCULATION',
            'UF_PROJECT_SUMM',
            'UF_SPECIFICATION_OF_PRODUCTS_CREATE',
            'UF_PRODUCT_CARD_IS_FILLED_AND_FILES_UPLOADED',
            'UF_TRANSFERRED_TO_MP'
        ],
        'C7:6' => ['UF_CONTRACT_IS_APPROVED'],
        'C7:7' => ['UF_SUMM_PROJECT_WAS_SOLD', 'UF_CONTRACT_SCAN'],
        'C7:8' => ['UF_INVOICE'],
        'C7:10' => ['UF_PROJECT_TRANSFERRED_TO_MP'],
        'C7:DESIGN_TASKS' => ['UF_TASKS_FOR_DESIGN_PRODUCTS_IS_SET'],
        'C7:APPROVE_TASKS' => ['UF_TASKS_FOR_APPROVAL_IS_SET'],
        'C7:11' => ['UF_SKETCHES_CD_IS_APPROVED', 'UF_RECONCILIATION_WITH_CUSTOMER_IS_CREATED'],
        'C7:12' => ['UF_CALCULATE_ECONOMY_BY_CD', 'UF_CD_UPLOADED_TO_PROJECT_FOLDER'],
        'C7:PROJECT_FEATURES' => ['UF_FEATURES_PROJECT_IS_FILLED'],
        'C7:13' => ['UF_ASKD_WAS_MADE_AND_SIGN', 'UF_ASKD_SCAN'],
        'C7:PURCHASES_WORKING' => ['UF_ANALYSIS_PRODUCT_BY_MATERIALS'],
        'C7:14' => ['UF_REPORT_ON_WORK_HAS_MADE', 'UF_MATERIALS_PURCHASED'],
        'C7:15' => ['UF_INSTALLER_WAS_FOUND'],
        'C7:16' => ['UF_SUMM_OF_PRODUCT_SHIPPED'],
        'C7:17' => ['UF_UPD_WAS_SIGNED'],
        'C7:18' => ['UF_RECONCILIATION_WITH_INSTALLERS'],
        'C7:19' => ['UF_APP_WAS_SIGNED_UPON_COMPLETION_OF_THE_PROJECT'],
        'C7:20' => ['UF_SALE_DOCUMENTS_WAS_UPLOADED'],
        'C7:DOWNLOAD_DOCS' => ['UF_ALL_DOCUMENTS_WAS_UPLOADED', 'UF_DOCUMENTS_WAS_UPLOADED_ON_TIME'],
        'C7:WON' => ['UF_OS_RECEIVED'],
    ];

}