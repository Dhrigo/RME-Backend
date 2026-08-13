<?php

namespace Modules\GeneralGuarantorSubspecialty\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralGuarantorSubspecialty\Http\Requests\StoreGuarantorSubspecialtyRequest;
use Modules\GeneralGuarantorSubspecialty\Http\Requests\UpdateGuarantorSubspecialtyRequest;
use Modules\GeneralGuarantorSubspecialty\Http\Resources\GuarantorSubspecialtyResource;
use Modules\GeneralGuarantorSubspecialty\Models\GuarantorSubspecialty;

class GuarantorSubspecialtyController extends Controller
{
    public function index(Request $request)
    {
        $query = GuarantorSubspecialty::query();

        if ($request->filled('guarantor_id')) {
            $query->where('guarantor_id', $request->integer('guarantor_id'));
        }

        return GuarantorSubspecialtyResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreGuarantorSubspecialtyRequest $request)
    {
        $subspecialty = GuarantorSubspecialty::create($request->validated());

        return (new GuarantorSubspecialtyResource($subspecialty))->response()->setStatusCode(201);
    }

    public function show(GuarantorSubspecialty $guarantor_subspecialty): GuarantorSubspecialtyResource
    {
        return new GuarantorSubspecialtyResource($guarantor_subspecialty);
    }

    public function update(UpdateGuarantorSubspecialtyRequest $request, GuarantorSubspecialty $guarantor_subspecialty): GuarantorSubspecialtyResource
    {
        $guarantor_subspecialty->update($request->validated());

        return new GuarantorSubspecialtyResource($guarantor_subspecialty);
    }

    public function destroy(GuarantorSubspecialty $guarantor_subspecialty)
    {
        $guarantor_subspecialty->delete();

        return response()->json(null, 204);
    }
}
