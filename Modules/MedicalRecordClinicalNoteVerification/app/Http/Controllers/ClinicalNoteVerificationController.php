<?php

namespace Modules\MedicalRecordClinicalNoteVerification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordClinicalNoteVerification\Http\Requests\ClinicalNoteVerificationRequest;
use Modules\MedicalRecordClinicalNoteVerification\Http\Resources\ClinicalNoteVerificationResource;
use Modules\MedicalRecordClinicalNoteVerification\Models\ClinicalNoteVerification;

class ClinicalNoteVerificationController extends Controller
{
    public function index(Request $request)
    {
        $query = ClinicalNoteVerification::query();

        if ($request->filled('clinical_note_id')) {
            $query->where('clinical_note_id', $request->integer('clinical_note_id'));
        }

        if ($request->filled('verifier_doctor_id')) {
            $query->where('verifier_doctor_id', $request->integer('verifier_doctor_id'));
        }

        return ClinicalNoteVerificationResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(ClinicalNoteVerificationRequest $request)
    {
        $data = $request->validated();
        $data['verification_status'] ??= 'Verified';
        $data['created_by'] = $request->user()?->id;

        $verification = ClinicalNoteVerification::create($data);

        return (new ClinicalNoteVerificationResource($verification))->response()->setStatusCode(201);
    }

    public function show(ClinicalNoteVerification $verification): ClinicalNoteVerificationResource
    {
        return new ClinicalNoteVerificationResource($verification);
    }

    public function update(ClinicalNoteVerificationRequest $request, ClinicalNoteVerification $verification): ClinicalNoteVerificationResource
    {
        $verification->update($request->validated());

        return new ClinicalNoteVerificationResource($verification);
    }

    public function destroy(ClinicalNoteVerification $verification)
    {
        $verification->delete();

        return response()->json(['message' => 'Clinical note verification record deleted successfully']);
    }
}
