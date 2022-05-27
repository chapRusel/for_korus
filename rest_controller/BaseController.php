<?php

namespace IITCompany\Marketplace\Controller;

use Bitrix\Main\Context;
use Bitrix\Main\HttpRequest;
use IITCompany\Marketplace\Exception\RestException;
use IITCompany\Marketplace\Model\ModelInterface;

/**
 * @OA\Info(
 *     description="This example presents methods for working with paying for parking, receiving invoices, and the responses provided by the server.",
 *     version="1.0.0",
 *     title="УК Культура",
 * )
 * @OA\Tag(
 *     name="Parking",
 *     description="Methods for parking pay",
 * )
 * @OA\Tag(
 *     name="Insurance",
 *     description="Methods for insurance pay",
 * )
 * @OA\Tag(
 *     name="Marketplace",
 *     description="Methods for marketplace products and services",
 * )
 * @OA\Tag(
 *     name="Common",
 *     description="Common methods",
 * )
 * @OA\Server(
 *     description="Test area",
 *     url="https://cultura.r.dev.iit.company/rest"
 * )
 */
abstract class BaseController implements ControllerInterface
{
    protected $response;
    protected $obModel;
    protected $namespace;
    protected $className;
    protected $function;
    protected $requiredFields;
    protected $query;
    protected $method;
    protected $request;
    protected $arPath;

    protected function getRequest(): HttpRequest
    {
        return Context::getCurrent()->getRequest();
    }

    public static function onInit()
    {
        $obRestApiController = new RestApiController();
        $obRestApiController->init();
    }

    public function setResponse(bool $status, $response)
    {
        $this->response = [
            'query' => $this->query,
            'result' => $status,
            'response' => $response
        ];
    }

    public function outResponse()
    {
        echo json_encode($this->getResponse());
        die();
    }

    public function setHeaders()
    {
        header('Content-Type: application/json');
    }

    protected function setMethodDescription($method)
    {
        $arMethod = explode('.', $method);
        $this->namespase = ucfirst($arMethod[1]);
        $this->className = ucfirst($arMethod[2]);
        $this->function = $arMethod[3];
    }

    public function setObModel(ModelInterface $obModel): BaseController
    {
        $this->obModel = $obModel;
        return $this;
    }

    public function getObModel()
    {
        return $this->obModel;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function getFunction()
    {
        return $this->function;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getRequiredFields()
    {
        return $this->requiredFields;
    }

    public function setRequiredFields($arFields)
    {
        $this->requiredFields = $arFields;
    }


    public function checkRequiredFields(array $params)
    {
        $queryKeys = array_keys($params);

        foreach ($this->requiredFields as $key => $name) {
            if (!in_array($name, $queryKeys)) {
                throw new RestException("Не передано обязательное поле $name", 400);
            }
        }
    }
}