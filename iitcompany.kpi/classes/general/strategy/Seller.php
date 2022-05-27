<?php

namespace IITCompany\KPI\Strategy;

class Seller extends Employee
{
    protected $roleTitle = 'Продавец';
    protected $roleId = 1;
    protected $roleFields = [
        'UF_DEAL_SUMM',
        'UF_INTERACTION_FEATURES',
        'UF_SENT_FOR_CALCULATION',
        'UF_PROJECT_SUMM',
        'UF_SPECIFICATION_OF_PRODUCTS_CREATE',
        'UF_PRODUCT_CARD_IS_FILLED_AND_FILES_UPLOADED',
        'UF_TRANSFERRED_TO_MP',
        'UF_SUMM_PROJECT_WAS_SOLD',
        'UF_CONTRACT',
        'UF_BASIC_TERMS_OF_CONTRACT',
        'UF_CONTRACT_SCAN',
        'UF_PROJECT_TRANSFERRED_TO_MP',
        'UF_FEATURES_PROJECT_IS_FILLED',
        'UF_SALE_DOCUMENTS_WAS_UPLOADED',
    ];
}