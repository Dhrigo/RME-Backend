<?php

namespace Modules\Authorization\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Authorization\Http\Requests\StorePermissionRequest;
use Modules\Authorization\Http\Resources\PermissionResource;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return PermissionResource::collection(Permission::paginate(15));
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create(['name' => $request->string('name')]);

        return (new PermissionResource($permission))->response()->setStatusCode(201);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json(null, 204);
    }
}
