<?php

namespace Modules\GeneralScannedDocument\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralScannedDocument\Http\Requests\StoreScannedDocumentRequest;
use Modules\GeneralScannedDocument\Http\Resources\ScannedDocumentResource;
use Modules\GeneralScannedDocument\Models\ScannedDocument;

class GeneralScannedDocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = ScannedDocument::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return ScannedDocumentResource::collection($query->latest('scanned_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Scanned documents are append-only records - no update/delete.
     */
    public function store(StoreScannedDocumentRequest $request)
    {
        $document = ScannedDocument::create($request->validated());

        return (new ScannedDocumentResource($document))->response()->setStatusCode(201);
    }

    public function show(ScannedDocument $scannedDocument): ScannedDocumentResource
    {
        return new ScannedDocumentResource($scannedDocument);
    }
}
