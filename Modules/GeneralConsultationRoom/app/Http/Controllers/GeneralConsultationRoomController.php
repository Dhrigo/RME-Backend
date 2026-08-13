<?php

namespace Modules\GeneralConsultationRoom\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralConsultationRoom\Models\ConsultationRoom;

class GeneralConsultationRoomController extends Controller
{
    public function index(Request $request)
    {
        $query = ConsultationRoom::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return $query->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'consultation_type' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ConsultationRoom::create($data)->refresh(), 201);
    }

    public function show(ConsultationRoom $consultationRoom): ConsultationRoom
    {
        return $consultationRoom;
    }

    public function update(Request $request, ConsultationRoom $consultationRoom): ConsultationRoom
    {
        $data = $request->validate([
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'consultation_type' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $consultationRoom->update($data);

        return $consultationRoom;
    }

    public function destroy(ConsultationRoom $consultationRoom)
    {
        $consultationRoom->delete();

        return response()->json(null, 204);
    }
}
