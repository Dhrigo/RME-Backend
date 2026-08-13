<?php

namespace Modules\MedicalRecordProcedureConsentInformationItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordProcedureConsentInformationItem\Http\Requests\StoreProcedureConsentInformationItemRequest;
use Modules\MedicalRecordProcedureConsentInformationItem\Http\Resources\ProcedureConsentInformationItemResource;
use Modules\MedicalRecordProcedureConsentInformationItem\Models\ProcedureConsentInformationItem;

class ProcedureConsentInformationItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ProcedureConsentInformationItem::query();

        if ($request->filled('information_id')) {
            $query->where('information_id', $request->integer('information_id'));
        }

        return ProcedureConsentInformationItemResource::collection($query->latest('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreProcedureConsentInformationItemRequest $request)
    {
        $data = $request->validated();
        $data['is_explained'] ??= false;
        $data['is_understood'] ??= false;
        $data['created_by'] = $request->user()->id;

        $record = ProcedureConsentInformationItem::create($data);

        return (new ProcedureConsentInformationItemResource($record))->response()->setStatusCode(201);
    }

    public function show(ProcedureConsentInformationItem $record): ProcedureConsentInformationItemResource
    {
        return new ProcedureConsentInformationItemResource($record);
    }
}
