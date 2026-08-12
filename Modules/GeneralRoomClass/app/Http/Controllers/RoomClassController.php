<?php

namespace Modules\GeneralRoomClass\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralRoomClass\Models\RoomClass;

class RoomClassController extends Controller
{
    public function index()
    {
        return RoomClass::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:room_classes,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:room_classes,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(RoomClass::create($data)->refresh(), 201);
    }

    public function show(RoomClass $room_class): RoomClass
    {
        return $room_class;
    }

    public function update(Request $request, RoomClass $room_class): RoomClass
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('room_classes', 'name')->ignore($room_class->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('room_classes', 'code')->ignore($room_class->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $room_class->update($data);

        return $room_class;
    }

    public function destroy(RoomClass $room_class)
    {
        $room_class->delete();

        return response()->json(null, 204);
    }
}
