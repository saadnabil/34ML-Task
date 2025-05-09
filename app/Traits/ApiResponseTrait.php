<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function sendResponse($data, $status = 'success', $error = '', $code = 200)
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
            'error' => $error,
            'code' => $code
        ], $code);
    }
}
