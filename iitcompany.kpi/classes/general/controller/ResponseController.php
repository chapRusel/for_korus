<?php

namespace IITCompany\KPI\Controller;

class ResponseController
{
    private $response;

    public function __construct($result, $response)
    {
        $this->response = [
            'result' => $result,
            'response' => $response
        ];
    }

    public function getResponse(): array
    {
        return $this->response;
    }
}