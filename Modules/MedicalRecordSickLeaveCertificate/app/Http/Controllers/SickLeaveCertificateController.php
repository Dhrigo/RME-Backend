<?php

namespace Modules\MedicalRecordSickLeaveCertificate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordSickLeaveCertificate\Http\Requests\SickLeaveCertificateRequest;
use Modules\MedicalRecordSickLeaveCertificate\Http\Resources\SickLeaveCertificateResource;
use Modules\MedicalRecordSickLeaveCertificate\Models\SickLeaveCertificate;

class SickLeaveCertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = SickLeaveCertificate::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return SickLeaveCertificateResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(SickLeaveCertificateRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $certificate = SickLeaveCertificate::create($data);

        return (new SickLeaveCertificateResource($certificate))->response()->setStatusCode(201);
    }

    public function show(SickLeaveCertificate $certificate): SickLeaveCertificateResource
    {
        return new SickLeaveCertificateResource($certificate);
    }

    public function update(SickLeaveCertificateRequest $request, SickLeaveCertificate $certificate): SickLeaveCertificateResource
    {
        $certificate->update($request->validated());

        return new SickLeaveCertificateResource($certificate);
    }

    public function destroy(SickLeaveCertificate $certificate)
    {
        $certificate->delete();

        return response()->json(['message' => 'Sick leave certificate deleted successfully']);
    }
}
