<?php

namespace Modules\SatuSehatSpesialistik\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SatuSehatSpesialistik\Models\SpesialistikSubmission;
use Modules\SatuSehatSpesialistik\Services\SpesialistikService;

class SatuSehatSpesialistikController extends Controller
{
    public function __construct(private readonly SpesialistikService $service)
    {
    }

    public function index(Request $request)
    {
        $query = SpesialistikSubmission::query();
        if ($request->filled('use_case')) {
            $query->where('use_case', $request->string('use_case'));
        }
        if ($request->filled('encounter_local_id')) {
            $query->where('encounter_local_id', $request->integer('encounter_local_id'));
        }

        return $query->latest()->paginate($request->integer('per_page', 15));
    }

    public function show(SpesialistikSubmission $spesialistikSubmission)
    {
        return $spesialistikSubmission;
    }

    /**
     * Submit a use-case's FHIR resource/Bundle. $useCase is the route segment
     * (gigi/mata/telinga/geriatri/ubm); the caller assembles the FHIR payload
     * client-side per the relevant SATUSEHAT Postman collection and posts it
     * here along with which resourceType/Bundle it is.
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
