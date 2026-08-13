<?php

namespace Modules\GeneralGuarantorWardAccess\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralGuarantorWardAccess\Http\Requests\StoreGuarantorWardAccessRequest;
use Modules\GeneralGuarantorWardAccess\Http\Requests\UpdateGuarantorWardAccessRequest;
use Modules\GeneralGuarantorWardAccess\Http\Resources\GuarantorWardAccessResource;
use Modules\GeneralGuarantorWardAccess\Models\GuarantorWardAccess;

class GuarantorWardAccessController extends Controller
{
    public function index(Request $request)
    {
        $query = GuarantorWardAccess::query();

        if ($request->filled('guarantor_id')) {
            $query->where('guarantor_id', $request->integer('guarantor_id'));
        }

        return GuarantorWardAccessResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreGuarantorWardAccessRequest $request)
    {
        $access = GuarantorWardAccess::create($request->validated());

        return (new GuarantorWardAccessResource($access))->response()->setStatusCode(201);
    }

    public function show(GuarantorWardAccess $guarantor_ward_access): GuarantorWardAccessResource
    {
        return new GuarantorWardAccessResource($guarantor_ward_access);
    }

    public function update(UpdateGuarantorWardAccessRequest $request, GuarantorWardAccess $guarantor_ward_access): GuarantorWardAccessResource
    {
        $guarantor_ward_access->update($request->validated());

        return new GuarantorWardAccessResource($guarantor_ward_access);
    }

    public function destroy(GuarantorWardAccess $guarantor_ward_access)
    {
        $guarantor_ward_access->delete();

        return response()->json(null, 204);
    }
}
