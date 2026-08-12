<?php

namespace Modules\Authorization\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Authorization\Http\Requests\StoreRoleRequest;
use Modules\Authorization\Http\Requests\UpdateRoleRequest;
use Modules\Authorization\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::with('permissions')->paginate(15));
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create(['name' => $request->string('name')]);

        if ($request->filled('permissions')) {
            $role->syncPermissions($request->array('permissions'));
        }

        return (new RoleResource($role->load('permissions')))->response()->setStatusCode(201);
    }

    public function show(Role $role): RoleResource
    {
        return new RoleResource($role->load('permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RoleResource
    {
        if ($request->filled('name')) {
            $role->update(['name' => $request->string('name')]);
        }

        if ($request->has('permissions')) {
            $role->syncPermissions($request->array('permissions'));
        }

        return new RoleResource($role->load('permissions'));
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(null, 204);
    }
}
