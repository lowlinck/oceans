<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::with(['profiles', 'profiles.roles'])->get();  // Получаем пользователей с профилями и ролями
        $enumRoles = RoleEnum::cases();
        $roles = Role::all();



        return inertia('Admin/Users/Index', compact('users', 'roles', 'enumRoles'));
    }
}
