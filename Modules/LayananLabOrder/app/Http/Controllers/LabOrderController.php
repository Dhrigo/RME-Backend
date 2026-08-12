<?php

namespace Modules\LayananLabOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabOrder\Http\Requests\StoreLabOrderRequest;
use Modules\LayananLabOrder\Http\Requests\UpdateLabOrderRequest;
use Modules\LayananLabOrder\Http\Resources\LabOrderResource;
use Modules\LayananLabOrder\Models\LabOrder;

class LabOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = LabOrder::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return LabOrderResource::collection($query->latest('ordered_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabOrderRequest $request)
    {
        $data = $request->validated();
        $data['order_number'] ??= LabOrder::generateOrderNumber();
        $data['ordered_at'] ??= now();

        $order = LabOrder::create($data);

        return (new LabOrderResource($order))->response()->setStatusCode(201);
    }

    public function show(LabOrder $lab_order): LabOrderResource
    {
        return new LabOrderResource($lab_order->load('results'));
    }

    /**
     * Only the status field is editable here (workflow transition) - the clinical
     * order details themselves are not, same append-only reasoning as ClinicalNote.
     */
    public function update(UpdateLabOrderRequest $request, LabOrder $lab_order): LabOrderResource
    {
        $lab_order->update($request->validated());

        return new LabOrderResource($lab_order);
    }
}
