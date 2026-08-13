<?php

namespace Modules\PendaftaranServiceHandover\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranServiceHandover\Http\Requests\ReceiveServiceHandoverRequest;
use Modules\PendaftaranServiceHandover\Http\Requests\StoreServiceHandoverRequest;
use Modules\PendaftaranServiceHandover\Http\Resources\ServiceHandoverResource;
use Modules\PendaftaranServiceHandover\Models\ServiceHandover;

class ServiceHandoverController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceHandover::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ServiceHandoverResource::collection($query->latest('handed_over_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreServiceHandoverRequest $request)
    {
        $data = $request->validated();
        $data['handed_over_at'] ??= now();
        $data['handed_over_by'] = $request->user()->id;
        $data['status'] = 'pending';

        $handover = ServiceHandover::create($data);

        return (new ServiceHandoverResource($handover))->response()->setStatusCode(201);
    }

    public function show(ServiceHandover $service_handover): ServiceHandoverResource
    {
        return new ServiceHandoverResource($service_handover);
    }

    /**
     * Receiving/rejecting is a one-way transition, same as InventoryStockRequest's
     * fulfill/reject - a handover already received or rejected cannot be re-processed.
     */
    public function update(ReceiveServiceHandoverRequest $request, ServiceHandover $service_handover): ServiceHandoverResource
    {
        if ($service_handover->status !== 'pending') {
            abort(422, 'Serah terima ini sudah diproses.');
        }

        $data = $request->validated();

        if ($data['status'] === 'received') {
            $service_handover->update([
                'status' => 'received',
                'received_by' => $data['received_by'],
                'received_at' => now(),
                'notes' => $data['notes'] ?? $service_handover->notes,
            ]);
        } else {
            $service_handover->update([
                'status' => 'rejected',
                'notes' => $data['notes'] ?? $service_handover->notes,
            ]);
        }

        return new ServiceHandoverResource($service_handover->fresh());
    }
}
