<?php

namespace Modules\LayananPrescriptionItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPrescriptionItem\Http\Requests\StorePrescriptionItemRequest;
use Modules\LayananPrescriptionItem\Http\Resources\PrescriptionItemResource;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;

class PrescriptionItemController extends Controller
{
    public function index(Request $request)
    {
        $query = PrescriptionItem::query();

        if ($request->filled('prescription_id')) {
            $query->where('prescription_id', $request->integer('prescription_id'));
        }

        return PrescriptionItemResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePrescriptionItemRequest $request)
    {
        $item = PrescriptionItem::create($request->validated());

        return (new PrescriptionItemResource($item))->response()->setStatusCode(201);
    }

    public function show(PrescriptionItem $prescription_item): PrescriptionItemResource
    {
        return new PrescriptionItemResource($prescription_item);
    }
}
