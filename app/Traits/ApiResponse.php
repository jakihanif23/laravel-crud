<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function respondShow($data, $code = 200, $message = null): JsonResponse
    {
        return response()->json([
            'message' => $message ?? 'Success',
            'code'=> $code,
            'data' => $data,
        ], $code);
    }
}
