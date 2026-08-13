<?php

namespace Modules\MedicalRecordObstetrics\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordObstetrics\Http\Requests\StoreObstetricsRequest;
use Modules\MedicalRecordObstetrics\Http\Requests\UpdateObstetricsRequest;
use Modules\MedicalRecordObstetrics\Http\Resources\ObstetricsResource;
use Modules\MedicalRecordObstetrics\Models\Obstetrics;

class ObstetricsController extends Controller
{
    public function index(Request $request)
    {
        $query = Obstetrics::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return ObstetricsResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreObstetricsRequest $request)
    {
        $data = $request->validated();
        $data['gravida'] ??= 0;
        $data['para'] ??= 0;
        $data['abortus'] ??= 0;
        $data['examined_at'] ??= now();

        $record = Obstetrics::create($data);

        return (new ObstetricsResource($record))->response()->setStatusCode(201);
    }

    public function show(Obstetrics $record): ObstetricsResource
    {
        return new ObstetricsResource($record);
    }

    public function update(UpdateObstetricsRequest $request, Obstetrics $record): ObstetricsResource
    {
        $record->update($request->validated());

        return new ObstetricsResource($record);
    }

    public function destroy(Obstetrics $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
