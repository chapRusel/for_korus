<?php

namespace IIT\Illuminate\App\Http\Requests;


use IIT\Illuminate\Validator\ValidatorFactory;

/**
 * Class ApiFormRequest
 *
 * @package IIT\Illuminate\App\Http\Requests
 */
class ApiFormRequest
{
    /**
     * @throws \JsonException
     */
    public static function init(array $request, array $rules = [])
    {
        return ValidatorFactory::getInstance()->setRequest($request)->make($rules, true);
    }
}
