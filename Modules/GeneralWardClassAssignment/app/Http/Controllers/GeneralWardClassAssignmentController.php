<?php

namespace Modules\GeneralWardClassAssignment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralWardClassAssignment\Models\WardClassAssignment;

class GeneralWardClassAssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = WardClassAssignment::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return $query->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'room_class_id' => ['required', 'integer', 'exists:room_classes,id'],
        ]);

        return response()->json(WardClassAssignment::create($data)->refresh(), 201);
    }

    public function show(WardClassAssignment $wardClassAssignment): WardClassAssignment
    {
        return $wardClassAssignment;
    }

    public function update(Request $request, WardClassAssignment $wardClassAssignment): WardClassAssignment
    {
        $data = $request->validate([
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'room_class_id' => ['sometimes', 'integer', 'exists:room_classes,id'],
        ]);

        $wardClassAssignment->update($data);

        return $wardClassAssignment;
    }

    public function destroy(WardClassAssignment $wardClassAssignment)
    {
        $wardClassAssignment->delete();

        return response()->json(null, 204);
    }
}
