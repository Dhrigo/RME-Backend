<?php

namespace Modules\MedicalRecordTranscranialDopplerWindow\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordTranscranialDopplerWindow\Http\Requests\StoreTranscranialDopplerWindowRequest;
use Modules\MedicalRecordTranscranialDopplerWindow\Http\Requests\UpdateTranscranialDopplerWindowRequest;
use Modules\MedicalRecordTranscranialDopplerWindow\Http\Resources\TranscranialDopplerWindowResource;
use Modules\MedicalRecordTranscranialDopplerWindow\Models\TranscranialDopplerWindow;

class TranscranialDopplerWindowController extends Controller
{
    public function index(Request $request)
    {
        $query = TranscranialDopplerWindow::query();


        if ($request->filled('transcranial_doppler_examination_id')) {
            $query->where('transcranial_doppler_examination_id', $request->integer('transcranial_doppler_examination_id'));
        }

        return TranscranialDopplerWindowResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreTranscranialDopplerWindowRequest $request)
    {
        $data = $request->validated();

        $record = TranscranialDopplerWindow::create($data);

        return (new TranscranialDopplerWindowResource($record))->response()->setStatusCode(201);
    }

    public function show(TranscranialDopplerWindow $record): TranscranialDopplerWindowResource
    {
        return new TranscranialDopplerWindowResource($record);
    }

    public function update(UpdateTranscranialDopplerWindowRequest $request, TranscranialDopplerWindow $record): TranscranialDopplerWindowResource
    {
        $record->update($request->validated());

        return new TranscranialDopplerWindowResource($record);
    }

    public function destroy(TranscranialDopplerWindow $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
