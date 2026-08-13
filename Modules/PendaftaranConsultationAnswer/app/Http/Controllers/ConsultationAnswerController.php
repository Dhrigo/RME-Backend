<?php

namespace Modules\PendaftaranConsultationAnswer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranConsultationAnswer\Http\Requests\StoreConsultationAnswerRequest;
use Modules\PendaftaranConsultationAnswer\Http\Resources\ConsultationAnswerResource;
use Modules\PendaftaranConsultationAnswer\Models\ConsultationAnswer;

class ConsultationAnswerController extends Controller
{
    public function index(Request $request)
    {
        $query = ConsultationAnswer::query();

        if ($request->filled('consultation_id')) {
            $query->where('consultation_id', $request->integer('consultation_id'));
        }

        return ConsultationAnswerResource::collection($query->latest('answered_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreConsultationAnswerRequest $request)
    {
        $data = $request->validated();
        $data['answered_at'] ??= now();

        $answer = ConsultationAnswer::create($data);

        return (new ConsultationAnswerResource($answer))->response()->setStatusCode(201);
    }

    public function show(ConsultationAnswer $consultationanswer): ConsultationAnswerResource
    {
        return new ConsultationAnswerResource($consultationanswer);
    }
}
