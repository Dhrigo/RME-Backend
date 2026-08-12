<?php

namespace Modules\GeneralBed\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralBed\Models\Bed;

class BedController extends Controller
{
    public function index(Request $request)
    {
        $query = Bed::query();

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->integer('room_id'));
        }

        return $query->orderBy('bed_number')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => ['required', 'integer', 'exists:rooms,id'],
            'bed_number' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Bed::create($data)->refresh(), 201);
    }

    public function show(Bed $bed): Bed
    {
        return $bed;
    }

    public function update(Request $request, Bed $bed): Bed
    {
        $data = $request->validate([
            'bed_number' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $bed->update($data);

        return $bed;
    }

    public function destroy(Bed $bed)
    {
        $bed->delete();

        return response()->json(null, 204);
    }
}
