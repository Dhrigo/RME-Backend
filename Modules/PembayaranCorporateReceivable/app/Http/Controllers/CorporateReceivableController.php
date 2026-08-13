<?php

namespace Modules\PembayaranCorporateReceivable\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranCorporateReceivable\Http\Requests\StoreCorporateReceivableRequest;
use Modules\PembayaranCorporateReceivable\Http\Requests\UpdateCorporateReceivableRequest;
use Modules\PembayaranCorporateReceivable\Http\Resources\CorporateReceivableResource;
use Modules\PembayaranCorporateReceivable\Models\CorporateReceivable;

class CorporateReceivableController extends Controller
{
    public function index(Request $request)
    {
        $query = CorporateReceivable::query();

        if ($request->filled('guarantor_id')) {
            $query->where('guarantor_id', $request->integer('guarantor_id'));
        }

        return CorporateReceivableResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreCorporateReceivableRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'outstanding';

        $receivable = CorporateReceivable::create($data);

        return (new CorporateReceivableResource($receivable))->response()->setStatusCode(201);
    }

    public function show(CorporateReceivable $corporate_receivable): CorporateReceivableResource
    {
        return new CorporateReceivableResource($corporate_receivable);
    }

    /**
     * Update is restricted to status transitions - amount/due_date are fixed at creation.
     */
    public function update(UpdateCorporateReceivableRequest $request, CorporateReceivable $corporate_receivable): CorporateReceivableResource
    {
        $corporate_receivable->update($request->validated());

        return new CorporateReceivableResource($corporate_receivable->fresh());
    }
}
