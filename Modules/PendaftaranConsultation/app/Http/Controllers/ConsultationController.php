<?php

namespace Modules\PendaftaranConsultation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranConsultation\Http\Requests\StoreConsultationRequest;
use Modules\PendaftaranConsultation\Http\Resources\ConsultationResource;
use Modules\PendaftaranConsultation\Models\Consultation;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $query = Consultation::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ConsultationResource::collection($query->latest('requested_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreConsultationRequest $request)
    {
        $data = $request->validated();
        $data['requested_at'] ??= now();

        $consultation = Consultation::create($data);

        return (new ConsultationResource($consultation))->response()->setStatusCode(201);
    }

    public function show(Consultation $consultation): ConsultationResource
    {
        return new ConsultationResource($consultation);
    }
}
