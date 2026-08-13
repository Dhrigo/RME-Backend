<?php

namespace Modules\MedicalRecordDocumentUpload\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDocumentUpload\Http\Requests\DocumentUploadRequest;
use Modules\MedicalRecordDocumentUpload\Http\Resources\DocumentUploadResource;
use Modules\MedicalRecordDocumentUpload\Models\DocumentUpload;

class DocumentUploadController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentUpload::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DocumentUploadResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(DocumentUploadRequest $request)
    {
        $data = $request->validated();
        $data['uploaded_at'] ??= now();
        $data['created_by'] = $request->user()?->id;

        $upload = DocumentUpload::create($data);

        return (new DocumentUploadResource($upload))->response()->setStatusCode(201);
    }

    public function show(DocumentUpload $upload): DocumentUploadResource
    {
        return new DocumentUploadResource($upload);
    }

    public function update(DocumentUploadRequest $request, DocumentUpload $upload): DocumentUploadResource
    {
        $upload->update($request->validated());

        return new DocumentUploadResource($upload);
    }

    public function destroy(DocumentUpload $upload)
    {
        $upload->delete();

        return response()->json(['message' => 'Document upload record deleted successfully']);
    }
}
