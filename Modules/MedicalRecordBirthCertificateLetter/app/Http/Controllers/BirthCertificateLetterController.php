<?php

namespace Modules\MedicalRecordBirthCertificateLetter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBirthCertificateLetter\Http\Requests\BirthCertificateLetterRequest;
use Modules\MedicalRecordBirthCertificateLetter\Http\Resources\BirthCertificateLetterResource;
use Modules\MedicalRecordBirthCertificateLetter\Models\BirthCertificateLetter;

class BirthCertificateLetterController extends Controller
{
    public function index(Request $request)
    {
        $query = BirthCertificateLetter::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return BirthCertificateLetterResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(BirthCertificateLetterRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $letter = BirthCertificateLetter::create($data);

        return (new BirthCertificateLetterResource($letter))->response()->setStatusCode(201);
    }

    public function show(BirthCertificateLetter $letter): BirthCertificateLetterResource
    {
        return new BirthCertificateLetterResource($letter);
    }

    public function update(BirthCertificateLetterRequest $request, BirthCertificateLetter $letter): BirthCertificateLetterResource
    {
        $letter->update($request->validated());

        return new BirthCertificateLetterResource($letter);
    }

    public function destroy(BirthCertificateLetter $letter)
    {
        $letter->delete();

        return response()->json(['message' => 'Birth certificate letter deleted successfully']);
    }
}
