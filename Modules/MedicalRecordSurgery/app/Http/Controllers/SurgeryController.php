<?php

namespace Modules\MedicalRecordSurgery\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordSurgery\Http\Requests\StoreSurgeryRequest;
use Modules\MedicalRecordSurgery\Http\Requests\UpdateSurgeryRequest;
use Modules\MedicalRecordSurgery\Http\Resources\SurgeryResource;
use Modules\MedicalRecordSurgery\Models\Surgery;

class SurgeryController extends Controller
{
    public function index(Request $request)
    {
        $query = Surgery::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return SurgeryResource::collection($query->latest('started_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSurgeryRequest $request)
    {
        $data = $request->validated();
        $data['started_at'] ??= now();
        $data['status'] ??= 'scheduled';
        $data['created_by'] = $request->user()->id;

        $surgery = Surgery::create($data);

        return (new SurgeryResource($surgery))->response()->setStatusCode(201);
    }

    public function show(Surgery $surgery): SurgeryResource
    {
        return new SurgeryResource($surgery);
    }

    /**
     * Only status/ended_at/notes are correctable - the procedure performed
     * and who performed it are not.
     */
    public function update(UpdateSurgeryRequest $request, Surgery $surgery): SurgeryResource
    {
        $surgery->update($request->validated());

        return new SurgeryResource($surgery);
    }
}
