<?php

namespace Modules\GeneralPharmacyGuarantorMargin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPharmacyGuarantorMargin\Http\Requests\StorePharmacyGuarantorMarginRequest;
use Modules\GeneralPharmacyGuarantorMargin\Http\Requests\UpdatePharmacyGuarantorMarginRequest;
use Modules\GeneralPharmacyGuarantorMargin\Http\Resources\PharmacyGuarantorMarginResource;
use Modules\GeneralPharmacyGuarantorMargin\Models\PharmacyGuarantorMargin;

class PharmacyGuarantorMarginController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyGuarantorMargin::query();

        if ($request->filled('guarantor_id')) {
            $query->where('guarantor_id', $request->integer('guarantor_id'));
        }

        return PharmacyGuarantorMarginResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyGuarantorMarginRequest $request)
    {
        $margin = PharmacyGuarantorMargin::create($request->validated());

        return (new PharmacyGuarantorMarginResource($margin))->response()->setStatusCode(201);
    }

    public function show(PharmacyGuarantorMargin $pharmacy_guarantor_margin): PharmacyGuarantorMarginResource
    {
        return new PharmacyGuarantorMarginResource($pharmacy_guarantor_margin);
    }

    public function update(UpdatePharmacyGuarantorMarginRequest $request, PharmacyGuarantorMargin $pharmacy_guarantor_margin): PharmacyGuarantorMarginResource
    {
        $pharmacy_guarantor_margin->update($request->validated());

        return new PharmacyGuarantorMarginResource($pharmacy_guarantor_margin);
    }

    public function destroy(PharmacyGuarantorMargin $pharmacy_guarantor_margin)
    {
        $pharmacy_guarantor_margin->delete();

        return response()->json(null, 204);
    }
}
