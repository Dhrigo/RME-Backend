<?php

namespace Modules\GeneralLaboratoryRoom\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralLaboratoryRoom\Models\LaboratoryRoom;

class GeneralLaboratoryRoomController extends Controller
{
    public function index(Request $request)
    {
        $query = LaboratoryRoom::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return $query->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'lab_type' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(LaboratoryRoom::create($data)->refresh(), 201);
    }

    public function show(LaboratoryRoom $laboratoryRoom): LaboratoryRoom
    {
        return $laboratoryRoom;
    }

    public function update(Request $request, LaboratoryRoom $laboratoryRoom): LaboratoryRoom
    {
        $data = $request->validate([
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'lab_type' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $laboratoryRoom->update($data);

        return $laboratoryRoom;
    }

    public function destroy(LaboratoryRoom $laboratoryRoom)
    {
        $laboratoryRoom->delete();

        return response()->json(null, 204);
    }
}
