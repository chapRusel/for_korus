<?php

namespace IIT\Illuminate\App\Http\Controllers;

use IIT\Illuminate\App\Repositories\EloquentRepository;
use IIT\Illuminate\App\Services\Container;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends Controller
{
    protected EloquentRepository $repository;
    protected Container $container;

    /**
     * @param  array|object  $data
     * @param  int           $status
     * @param  array         $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function response($data = [], int $status = Response::HTTP_OK, array $headers = []): JsonResponse
    {
        $response['result'] = true;
        if (!empty($data)) {
            $response['response'] = $data;
        }

        return ResponseFactory::json($response, $status, $headers);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseUnauthorized(): JsonResponse
    {
        $response['result'] = false;
        $response['error'] = "Метод требует авторизации. Недостаточно прав.";
        return ResponseFactory::json($response, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param  string | false  $customMessage
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseForbidden($customMessage = false): JsonResponse
    {
        $response['result'] = false;
        $response['error'] = $customMessage !== false ? 'DEV MODE: '.$customMessage : "Доступ запрещён. Недостаточно прав.";
        return ResponseFactory::json($response, Response::HTTP_FORBIDDEN);
    }

    /**
     * @param  array  $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function unsuccessfulResponse(array $data = []): JsonResponse
    {
        $response['result'] = false;
        if (!empty($data)) {
            $response['response'] = $data;
        }
        return ResponseFactory::json($response, Response::HTTP_OK);
    }

    /**
     * @param  string | false  $customMessage
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseNotFound($customMessage = false): JsonResponse
    {
        $response['result'] = false;
        $response['error'] = $customMessage !== false ? 'DEV MODE: '.$customMessage : "Запрашиваемые данные не найдены";
        return ResponseFactory::json($response, Response::HTTP_NOT_FOUND);
    }

    /**
     * @param  string | false  $customMessage
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseBadRequest($customMessage = false): JsonResponse
    {
        $response['result'] = false;
        $response['error'] = $customMessage !== false ? 'DEV MODE: '.$customMessage : "Произошла ошибка.";
        return ResponseFactory::json($response, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param  string | false  $customMessage
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseServerError($customMessage = false): JsonResponse
    {
        $response['result'] = false;
        $response['error'] = $customMessage !== false ? 'DEV MODE: '.$customMessage : "Произошла ошибка на сервере.";
        return ResponseFactory::json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}
