<?php

namespace Modules\GeneralStaffMember\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralStaffMember\Http\Requests\StoreStaffMemberRequest;
use Modules\GeneralStaffMember\Http\Requests\UpdateStaffMemberRequest;
use Modules\GeneralStaffMember\Http\Resources\StaffMemberResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class StaffMemberController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return StaffMemberResource::collection(StaffMember::all());
    }

    public function store(StoreStaffMemberRequest $request): StaffMemberResource
    {
        $staffMember = StaffMember::create($request->validated());
        return new StaffMemberResource($staffMember);
    }

    public function show(StaffMember $staffMember): StaffMemberResource
    {
        return new StaffMemberResource($staffMember);
    }

    public function update(UpdateStaffMemberRequest $request, StaffMember $staffMember): StaffMemberResource
    {
        $staffMember->update($request->validated());
        return new StaffMemberResource($staffMember);
    }

    public function destroy(StaffMember $staffMember): Response
    {
        $staffMember->delete();
        return response()->noContent();
    }
}
