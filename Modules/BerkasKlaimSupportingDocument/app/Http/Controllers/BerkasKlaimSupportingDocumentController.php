<?php

namespace Modules\BerkasKlaimSupportingDocument\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimSupportingDocument\Models\SupportingDocument;

class BerkasKlaimSupportingDocumentController extends Controller
{
    public function index()
    {
        return SupportingDocument::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'claim_file_id' => ['required', 'exists:claim_files,id'],
            'document_type' => ['required', 'string', 'max:255'],
            'file_path' => ['required', 'string', 'max:255'],
            'uploaded_at' => ['nullable', 'date'],
        ]);

        return response()->json(SupportingDocument::create($data)->refresh(), 201);
    }

    public function show(SupportingDocument $supporting_document)
    {
        return $supporting_document;
    }

    public function update(Request $request, SupportingDocument $supporting_document)
    {
        $data = $request->validate([
            'document_type' => ['sometimes', 'string', 'max:255'],
            'file_path' => ['sometimes', 'string', 'max:255'],
            'uploaded_at' => ['nullable', 'date'],
        ]);

        $supporting_document->update($data);

        return $supporting_document;
    }

    public function destroy(SupportingDocument $supporting_document)
    {
        $supporting_document->delete();

        return response()->json(null, 204);
    }
}
