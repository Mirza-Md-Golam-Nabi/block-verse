<?php
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $credentials = $request->only('email', 'password');

        $auth = Auth::attempt($credentials);

        if ($auth) {
            $user = Auth::user();

            $user['api_token']  = $user->createToken('BlockVerseTest')->accessToken;
            $user['token_type'] = "Bearer";

            return formatResponse(0, 200, 'You are logged in', $user);
        } else {
            return formatResponse(1, 200, 'Password and Phone number do not match', null);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return formatResponse(0, 200, "Successfully logged out", null);
    }
}
