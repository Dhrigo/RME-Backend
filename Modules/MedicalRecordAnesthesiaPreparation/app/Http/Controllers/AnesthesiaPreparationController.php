<?php

namespace Modules\MedicalRecordAnesthesiaPreparation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordAnesthesiaPreparation\Http\Requests\StoreAnesthesiaPreparationRequest;
use Modules\MedicalRecordAnesthesiaPreparation\Http\Resources\AnesthesiaPreparationResource;
use Modules\MedicalRecordAnesthesiaPreparation\Models\AnesthesiaPreparation;

class AnesthesiaPreparationController extends Controller
{
    public function index(Request $request)
    {
        $query = AnesthesiaPreparation::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return AnesthesiaPreparationResource::collection($query->latest('prepared_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAnesthesiaPreparationRequest $request)
    {
        $data = $request->validated();
        $data['allergy_checked'] ??= false;
        $data['consent_confirmed'] ??= false;
        $data['prepared_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = AnesthesiaPreparation::create($data);

        return (new AnesthesiaPreparationResource($record))->response()->setStatusCode(201);
    }

    public function show(AnesthesiaPreparation $record): AnesthesiaPreparationResource
    {
        return new AnesthesiaPreparationResource($record);
    }
}
