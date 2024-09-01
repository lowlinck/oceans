<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Http\Resources\User\RoleUserResource;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Profile $profile)
    {
        $roleData = $request->validated();

        $profile = Profile::findOrFail($roleData['profile_id']);
        $profile->syncRoles($roleData['title']);
        $profile->load('roles');
////        $role = Role::updateOrCreate(
////            ['profile_id' => $roleData['profile_id']],
////            ['title' => $roleData['title']]
////        );
////        $role = RoleUserResource::make($role)->resolve();
        return redirect()->back()->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
