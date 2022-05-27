<?php

namespace IIT\Illuminate\Handlers;


use IIT\Illuminate\ModuleSettings;

class ErrorHandler
{
    public function catch(): void
    {
        if (ModuleSettings::isProductionMode()) {
            set_exception_handler(function ($e) {
                if ($e) {
                    header('HTTP/1.0 500 Internal Server Error');
                    header('Content-Type: application/json');
                    $response['result'] = false;
                    $response['error'] = "Произошла ошибка на сервере.";
                    echo json_encode($response, JSON_THROW_ON_ERROR);
                }
            });
        }
    }
}
