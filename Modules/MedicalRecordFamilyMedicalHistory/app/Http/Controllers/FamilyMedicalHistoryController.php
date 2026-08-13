<?php

namespace Modules\MedicalRecordFamilyMedicalHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFamilyMedicalHistory\Http\Requests\StoreFamilyMedicalHistoryRequest;
use Modules\MedicalRecordFamilyMedicalHistory\Http\Resources\FamilyMedicalHistoryResource;
use Modules\MedicalRecordFamilyMedicalHistory\Models\FamilyMedicalHistory;

class FamilyMedicalHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = FamilyMedicalHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return FamilyMedicalHistoryResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreFamilyMedicalHistoryRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = FamilyMedicalHistory::create($data);

        return (new FamilyMedicalHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(FamilyMedicalHistory $record): FamilyMedicalHistoryResource
    {
        return new FamilyMedicalHistoryResource($record);
    }
}
