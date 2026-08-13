<?php
namespace Modules\PembatalanDocumentCancellation\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanDocumentCancellation\Models\DocumentCancellation;
class PembatalanDocumentCancellationController extends Controller {
    public function index() {
        return DocumentCancellation::query()->paginate(15);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'document_id' => ['required', 'string', 'max:255'],
            'document_type' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string'],
            'cancellation_date' => ['required', 'date'],
            'requested_by' => ['required', 'string', 'max:255'],
            'status' => ['sometimes', 'string'],
        ]);
        $data['cancellation_number'] = DocumentCancellation::generateCancellationNumber();
        return response()->json(DocumentCancellation::create($data)->refresh(), 201);
    }
    public function show(DocumentCancellation $document_cancellation) {
        return $document_cancellation;
    }
    public function update(Request $request, DocumentCancellation $document_cancellation) {
        $data = $request->validate([
            'reason' => ['sometimes', 'string'],
            'cancellation_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string'],
        ]);
        $document_cancellation->update($data);
        return $document_cancellation;
    }
    public function destroy(DocumentCancellation $document_cancellation) {
        $document_cancellation->delete();
        return response()->json(null, 204);
    }
}
