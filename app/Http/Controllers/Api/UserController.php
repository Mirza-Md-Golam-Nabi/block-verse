<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(private UserService $service)
    {
        $this->userService = $service;
    }

    public function index()
    {
        return formatResponse(0, 200, 'Users fetched successfully', $this->userService->getAllUser());
    }

    public function profile()
    {
        return formatResponse(0, 200, 'Profile fetched successfully', $this->userService->getProfile());
    }

    public function findUser()
    {
        return formatResponse(0, 200, 'User fetched successfully', $this->userService->findUser());
    }

    public function assignRole(Request $request, int $id)
    {
        return formatResponse(0, 200, 'Role assigned successfully', $this->userService->assignRole($request->role, $id));
    }
}
