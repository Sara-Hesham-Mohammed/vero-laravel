<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all(); // Retrieve all roles from the database
        if ($roles->isNotEmpty()) {
            return response()->json(['roles' => $roles]);
        } else {
            return response()->json([], 204);
        }
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
        //show with permissions

        $role = Role::with('permissions')->find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json(['role' => $role]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function assign_permission(Request $req, string $roleName)
    {
        $validated = $req->validate([
            'permissions' => 'required|array|exists:permissions,name'
        ]);

        $permissions = $validated['permissions'];

        // if ($validated->fails()) {
        //     return response()->json(['message' => 'Invalid data'], 422);
        // }

        $role = Role::findByName($roleName);

        if(! $role || !$permissions){
            return response()->json(['message'=>"Role or permission non existent"]);
        }

        $role->syncPermissions($permissions);

        return response()->json(['message'=>"Assigned permissions to role".$role->name]);
    }
}
