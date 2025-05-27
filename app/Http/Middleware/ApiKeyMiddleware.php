<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiKeyMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('api-key');

        $secret = $request->header('api-secret');

        $salt = $request->header('api-request-token');

        if (!$apiKey || !$secret || !$this->validateApiKeyAndSecret($apiKey, $secret, $salt)) {

            return abort(response()->json([

                "error" => "Invalid API Key or Secret",

            ], 403));

        }

        return $next($request);
    }

    public function validateApiKeyAndSecret(string $api_key, string $secret, string $salt): bool
    {
        $apiKey = ApiKey::firstWhere('key', $api_key);

        if ($apiKey == null) {

            return false;

        }

        $hash = md5($apiKey->key.$apiKey->secret.$salt);

        if ($hash != $secret) {

            return false;

        }

        return true;
    }
}