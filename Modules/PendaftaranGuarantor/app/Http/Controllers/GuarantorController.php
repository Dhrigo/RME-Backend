<?php

namespace Modules\PendaftaranGuarantor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranGuarantor\Http\Requests\StoreGuarantorRequest;
use Modules\PendaftaranGuarantor\Http\Requests\UpdateGuarantorRequest;
use Modules\PendaftaranGuarantor\Http\Resources\GuarantorResource;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class GuarantorController extends Controller
{
    public function index(Request $request)
    {
        $query = Guarantor::query();

        if ($request->filled('registration_id')) {
            $query->where('registration_id', $request->integer('registration_id'));
        }

        return GuarantorResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreGuarantorRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $guarantor = Guarantor::create($data);

        return (new GuarantorResource($guarantor))->response()->setStatusCode(201);
    }

    public function show(Guarantor $guarantor): GuarantorResource
    {
        return new GuarantorResource($guarantor);
    }

    public function update(UpdateGuarantorRequest $request, Guarantor $guarantor): GuarantorResource
    {
        $guarantor->update($request->validated());

        return new GuarantorResource($guarantor);
    }

    public function destroy(Guarantor $guarantor)
    {
        $guarantor->delete();

        return response()->json(null, 204);
    }
}
