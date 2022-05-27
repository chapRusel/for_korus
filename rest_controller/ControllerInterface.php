<?php

namespace IITCompany\Marketplace\Controller;

use IITCompany\Marketplace\Model\ModelInterface;

interface ControllerInterface
{
    public function getObModel();
    public function setObModel(ModelInterface $obModel);
    public function setRequiredFields(array $arFields);
    public function checkRequiredFields(array $params);
}