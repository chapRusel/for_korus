<?php

namespace IITCompany\KPI\Strategy;

class Production extends Employee
{
    protected $roleTitle = 'Управляющий производством';
    protected $roleId = 3;
    protected $roleFields = [
        'UF_ANALYSIS_PRODUCT_BY_MATERIALS',
        'UF_MATERIALS_PURCHASED',
        'UF_REPORT_ON_WORK_HAS_MADE',
        'UF_SUMM_OF_PRODUCT_SHIPPED',
    ];
}