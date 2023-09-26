<?php

namespace App\Traits;

trait RespondsWithHttpStatus
{
    protected function success($message, $data = [], $status = 200)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function failure($message, $status = 400)
    {
        return response([
            'success' => false,
            'message' => is_array($message) ? json_encode($message) : $message,
        ], $status);
    }
}
