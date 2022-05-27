<?php

namespace IITCompany\KPI\Strategy;

class Manager extends Employee
{
    protected $roleTitle = 'Менеджер проекта';
    protected $roleId = 2;
    protected $roleFields = [
        'UF_TASKS_FOR_APPROVAL_IS_SET',
        'UF_TASKS_FOR_DESIGN_PRODUCTS_IS_SET',
        'UF_SKETCHES_CD_IS_APPROVED',
        'UF_RECONCILIATION_WITH_CUSTOMER_IS_CREATED',
        'UF_CALCULATE_ECONOMY_BY_CD',
        'UF_CD_UPLOADED_TO_PROJECT_FOLDER',
        'UF_ASKD_WAS_MADE_AND_SIGN',
        'UF_ASKD_SCAN',
        'UF_INSTALLER_WAS_FOUND',
        'UF_UPD_WAS_SIGNED',
        'UF_RECONCILIATION_WITH_INSTALLERS',
        'UF_APP_WAS_SIGNED_UPON_COMPLETION_OF_THE_PROJECT',
        'UF_ALL_DOCUMENTS_WAS_UPLOADED',
        'UF_DOCUMENTS_WAS_UPLOADED_ON_TIME',
        'UF_OS_RECEIVED',
    ];
}