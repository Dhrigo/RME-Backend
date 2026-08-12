<?php

namespace Modules\GeneralRoom\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralRoom\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return $query->orderBy('room_number')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'room_number' => ['required', 'string', 'max:255'],
            'class_id' => ['nullable', 'integer', 'exists:room_classes,id'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Room::create($data)->refresh(), 201);
    }

    public function show(Room $room): Room
    {
        return $room;
    }

    public function update(Request $request, Room $room): Room
    {
        $data = $request->validate([
            'room_number' => ['sometimes', 'string', 'max:255'],
            'class_id' => ['nullable', 'integer', 'exists:room_classes,id'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $room->update($data);

        return $room;
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json(null, 204);
    }
}
