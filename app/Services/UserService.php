<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Collection;

class UserService
{
    public function getAllUser(): Collection
    {
        return User::all();
    }

    public function getProfile(): User
    {
        return authUser()->load('roles');
    }

    public function assignRole(string $role, int $id): User
    {
        $role_id = Role::where('title', strtolower($role))->value('id');
        $user = User::find($id);
        $user->roles()->attach($role_id);
        return $user->load('roles');
    }

    public function findUser(): User
    {
        $hasRole = RoleUser::pluck('user_id');
        return User::whereNotIn('id', $hasRole)->first();
    }
}
