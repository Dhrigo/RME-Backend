<?php

namespace Modules\MedicalRecordHealthCertificate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordHealthCertificate\Http\Requests\HealthCertificateRequest;
use Modules\MedicalRecordHealthCertificate\Http\Resources\HealthCertificateResource;
use Modules\MedicalRecordHealthCertificate\Models\HealthCertificate;

class HealthCertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = HealthCertificate::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return HealthCertificateResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(HealthCertificateRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $certificate = HealthCertificate::create($data);

        return (new HealthCertificateResource($certificate))->response()->setStatusCode(201);
    }

    public function show(HealthCertificate $certificate): HealthCertificateResource
    {
        return new HealthCertificateResource($certificate);
    }

    public function update(HealthCertificateRequest $request, HealthCertificate $certificate): HealthCertificateResource
    {
        $certificate->update($request->validated());

        return new HealthCertificateResource($certificate);
    }

    public function destroy(HealthCertificate $certificate)
    {
        $certificate->delete();

        return response()->json(['message' => 'Health certificate deleted successfully']);
    }
}
