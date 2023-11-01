<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class JsonResponseApi
{
    /**
     * @param string $message
     * @param array $additionalData
     * @param int $code
     * @return JsonResponse
     */
    public static function success(string $message, array $additionalData = [], int $code = Response::HTTP_OK): JsonResponse
    {
        $data = array_merge(['message' => $message], $additionalData);
        return response()->json($data)->setStatusCode($code);
    }

    /**
     * @param string $error
     * @param string $message
     * @param array $additionalData
     * @param int $code
     * @return JsonResponse
     */
    public static function error(string $error, string $message = '', array $additionalData = [], int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $data = [
            'error' => $error,
            'message' => $message,
            'metadata' => $additionalData
        ];
        return response()->json($data)->setStatusCode($code);
    }
}
