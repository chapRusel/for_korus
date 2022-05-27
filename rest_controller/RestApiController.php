<?php

namespace IITCompany\Marketplace\Controller;

use IITCompany\Marketplace\Exception\ModuleException;
use IITCompany\Marketplace\Exception\RestException;

class RestApiController extends BaseController
{
    const REST_MODULE_NAME = 'custom';

    public function __construct()
    {
        $this->request = $this->getRequest();
        $thisUrl = $this->request->getRequestUri();
        $arParsedUrl = parse_url($thisUrl);
        $this->arPath = array_filter(explode('/', $arParsedUrl['path']));
    }

    public function init()
    {
        try {
            $this->checkRestInPath();
            $this->checkCurrentRestModuleName();

            $obProxy = new RestProxyController(
                $this->arPath[2],
                $this->request->getQueryList()->toArray()
            );

            $response = $obProxy->runMethod();
            $this->setHeaders();
            $this->setResponse(true, $response);
            $this->outResponse();

            die();
        } catch (RestException $e) {
            $response = [];
            $response['error']['message'] = $e->getMessage();
            $response['error']['code'] = $e->getCode();

            $this->setHeaders();
            $this->setResponse(false, $response);
            $this->outResponse();
        } catch (ModuleException $e) {
            // todo continue page execute
        }
    }

    private function checkCurrentRestModuleName() {
        $arMethod = explode('.', $this->arPath[2]);

        if ($arMethod[0] !== self::REST_MODULE_NAME) {
            throw new ModuleException();
        }
    }

    private function checkRestInPath()
    {
        if (current($this->arPath) !== 'rest') {
            throw new ModuleException();
        }
    }
}