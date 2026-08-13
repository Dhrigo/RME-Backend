<?php

namespace Modules\MedicalRecordEyeExamDocumentUpload\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordEyeExamDocumentUpload\Http\Requests\EyeExamDocumentUploadRequest;
use Modules\MedicalRecordEyeExamDocumentUpload\Http\Resources\EyeExamDocumentUploadResource;
use Modules\MedicalRecordEyeExamDocumentUpload\Models\EyeExamDocumentUpload;

class EyeExamDocumentUploadController extends Controller
{
    public function index(Request $request)
    {
        $query = EyeExamDocumentUpload::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return EyeExamDocumentUploadResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(EyeExamDocumentUploadRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $upload = EyeExamDocumentUpload::create($data);

        return (new EyeExamDocumentUploadResource($upload))->response()->setStatusCode(201);
    }

    public function show(EyeExamDocumentUpload $upload): EyeExamDocumentUploadResource
    {
        return new EyeExamDocumentUploadResource($upload);
    }

    public function update(EyeExamDocumentUploadRequest $request, EyeExamDocumentUpload $upload): EyeExamDocumentUploadResource
    {
        $upload->update($request->validated());

        return new EyeExamDocumentUploadResource($upload);
    }

    public function destroy(EyeExamDocumentUpload $upload)
    {
        $upload->delete();

        return response()->json(['message' => 'Eye exam document upload record deleted successfully']);
    }
}
