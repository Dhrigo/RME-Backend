<?php

namespace Modules\GeneralOperatingRoom\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralOperatingRoom\Models\OperatingRoom;

class GeneralOperatingRoomController extends Controller
{
    public function index(Request $request)
    {
        $query = OperatingRoom::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return $query->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'room_number' => ['required', 'string', 'max:255'],
            'equipment_notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(OperatingRoom::create($data)->refresh(), 201);
    }

    public function show(OperatingRoom $operatingRoom): OperatingRoom
    {
        return $operatingRoom;
    }

    public function update(Request $request, OperatingRoom $operatingRoom): OperatingRoom
    {
        $data = $request->validate([
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'room_number' => ['sometimes', 'string', 'max:255'],
            'equipment_notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $operatingRoom->update($data);

        return $operatingRoom;
    }

    public function destroy(OperatingRoom $operatingRoom)
    {
        $operatingRoom->delete();

        return response()->json(null, 204);
    }
}
