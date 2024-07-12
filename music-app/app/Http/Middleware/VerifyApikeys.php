<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\apikeys;

class VerifyApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKeyValue = $request->header('x-api-key');

        if (!$apiKeyValue) {
            return response()->json(['message' => 'API key is missing'], 401);
        }

        $apiKey = Apikeys::where('key', $apiKeyValue)->first();

        if (!$apiKey) {
            return response()->json(['message' => 'Invalid API key'], 401);
        }

        // Authentifier l'utilisateur correspondant à l'API key
        auth()->login($apiKey->user);

        return $next($request);
    }
}
