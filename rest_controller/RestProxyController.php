<?php

namespace IITCompany\Marketplace\Controller;

use IITCompany\Marketplace\Exception\RestException;

class RestProxyController extends BaseController
{
    public function __construct(string $method, array $query)
    {
        $this->method = $method;
        $this->query = $query;

        $this->setMethodDescription($this->method);
    }

    public function runMethod()
    {
        $obClass = $this->formClassName();
        $this->checkMethod($obClass);

        return $obClass->{$this->function}($this->query);
    }

    private function formClassName(): object
    {
        $className = "IITCompany\\Marketplace\\{$this->namespase}\\Controller\\{$this->className}Controller";
        $this->checkClassName($className);

        return new $className($this->query);
    }

    private function checkMethod($object)
    {
        if (!method_exists($object, $this->function)) {
            throw new RestException("Метод $this->function не найден", 404);
        }
    }

    private function checkClassName($className)
    {
        if (!class_exists($className)) {
            throw new RestException("Класс $className не найден", 404);
        }
    }
}