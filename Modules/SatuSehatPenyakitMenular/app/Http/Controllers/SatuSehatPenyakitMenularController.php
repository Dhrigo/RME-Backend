<?php

namespace Modules\SatuSehatPenyakitMenular\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SatuSehatPenyakitMenular\Models\PenyakitMenularSubmission;
use Modules\SatuSehatPenyakitMenular\Services\PenyakitMenularService;

class SatuSehatPenyakitMenularController extends Controller
{
    public function __construct(private readonly PenyakitMenularService $service)
    {
    }

    public function index(Request $request)
    {
        $query = PenyakitMenularSubmission::query();
        if ($request->filled('use_case')) {
            $query->where('use_case', $request->string('use_case'));
        }
        if ($request->filled('encounter_local_id')) {
            $query->where('encounter_local_id', $request->integer('encounter_local_id'));
        }

        return $query->latest()->paginate($request->integer('per_page', 15));
    }

    public function show(PenyakitMenularSubmission $penyakitMenularSubmission)
    {
        return $penyakitMenularSubmission;
    }

    /**
     * Submit a use-case's FHIR resource/Bundle. $useCase is the route segment
     * (tuberkulosis/hiv/rabies/anthrax/smpk); caller assembles the FHIR
     * payload client-side per the relevant SATUSEHAT Postman collection.
     */
    public function store(Request $request, string $useCase)
    {
        $validated = $request->validate([
            'resource_type' => ['required', 'string'],
            'payload' => ['required', 'array'],
            'encounter_local_id' => ['nullable', 'integer'],
        ]);

        $submission = $this->service->submit(
            $useCase,
            $validated['resource_type'],
            $validated['payload'],
            $validated['encounter_local_id'] ?? null,
        );

        return response()->json($submission)->setStatusCode(201);
    }
}
