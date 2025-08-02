<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $role    = $request->query('role');
        $role_id = Role::where('title', $role)->value('id');
        $user_id = RoleUser::where('role_id', $role_id)->value('user_id');

        if ($user_id) {
            $auth              = Auth::loginUsingId($user_id);
            $auth['api_token'] = $this->apiToken($auth);
            return formatResponse(0, 200, ucfirst($role) . ' Login', $auth);
        }

        return formatResponse(1, 404, 'Not found', null);
    }

    public function apiToken(User $user): string
    {
        return $user->createToken('BlockVerseTest')->accessToken;
    }
}
