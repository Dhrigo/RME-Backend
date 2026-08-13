<?php

namespace Modules\MedicalRecordHospitalizationCertificate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordHospitalizationCertificate\Http\Requests\HospitalizationCertificateRequest;
use Modules\MedicalRecordHospitalizationCertificate\Http\Resources\HospitalizationCertificateResource;
use Modules\MedicalRecordHospitalizationCertificate\Models\HospitalizationCertificate;

class HospitalizationCertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = HospitalizationCertificate::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return HospitalizationCertificateResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(HospitalizationCertificateRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $certificate = HospitalizationCertificate::create($data);

        return (new HospitalizationCertificateResource($certificate))->response()->setStatusCode(201);
    }

    public function show(HospitalizationCertificate $certificate): HospitalizationCertificateResource
    {
        return new HospitalizationCertificateResource($certificate);
    }

    public function update(HospitalizationCertificateRequest $request, HospitalizationCertificate $certificate): HospitalizationCertificateResource
    {
        $certificate->update($request->validated());

        return new HospitalizationCertificateResource($certificate);
    }

    public function destroy(HospitalizationCertificate $certificate)
    {
        $certificate->delete();

        return response()->json(['message' => 'Hospitalization certificate deleted successfully']);
    }
}
