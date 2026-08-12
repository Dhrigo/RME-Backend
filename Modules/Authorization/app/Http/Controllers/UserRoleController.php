<?php

namespace Modules\Authorization\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Auth\Models\User;
use Modules\Authorization\Http\Requests\AssignRoleRequest;

class UserRoleController extends Controller
{
    public function index(User $user)
    {
        return response()->json(['roles' => $user->getRoleNames()]);
    }

    public function sync(AssignRoleRequest $request, User $user)
    {
        $user->syncRoles($request->array('roles'));

        return response()->json(['roles' => $user->getRoleNames()]);
    }
}
