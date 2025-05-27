<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait ApiUtilities
{
    private function apiValidate(Request $request, array $rules)
    {
        try {
            $request->validate($rules);
            return null;
        } catch (ValidationException $e) {
            return $e->validator->errors();
        }
    }

    private function respond(array $data, $message = 'Successful') {
        return [
            "message" => $message,
            "data" => $data
        ];
    }

    private function errorResponse(mixed $errors)  {
        return response()->json([
            'error' => $errors
        ], 422);
    }
}