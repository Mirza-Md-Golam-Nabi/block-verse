<?php

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;

if (!function_exists('authUser')) {
    function authUser(): ?User
    {
        if (Auth::check()) {
            return Auth::user();
        }

        return null;
    }
}

if (!function_exists('formatResponse')) {
    function formatResponse(int $error, int $code, string $msg, mixed $data): JsonResponse
    {
        return response()->json([
            'error' => $error,
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
    }
}

if (!function_exists('failedValidationForApi')) {
    function failedValidationForApi(Validator $validator): JsonResponse
    {
        return response()->json([
            'error' => 1,
            'code' => 422,
            'msg' => $validator->errors()->first(),
            'data' => null,
        ]);
    }
}
