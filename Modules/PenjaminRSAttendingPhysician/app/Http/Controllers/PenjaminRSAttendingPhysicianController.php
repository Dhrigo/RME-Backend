<?php

namespace Modules\PenjaminRSAttendingPhysician\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PenjaminRSAttendingPhysician\Models\AttendingPhysician;

class PenjaminRSAttendingPhysicianController extends Controller
{
    public function index(Request $request)
    {
        $query = AttendingPhysician::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return $query->paginate($request->integer('per_page', 15));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'visit_id' => ['required', 'exists:visits,id'],
            'employee_id' => ['required', 'exists:employees,id'],
            'assigned_at' => ['nullable', 'date'],
            'is_primary' => ['sometimes', 'boolean'],
        ]);

        $data['assigned_at'] = $data['assigned_at'] ?? now();

        return response()->json(AttendingPhysician::create($data)->refresh(), 201);
    }

    public function show(AttendingPhysician $attending_physician)
    {
        return $attending_physician;
    }

    public function update(Request $request, AttendingPhysician $attending_physician)
    {
        $data = $request->validate([
            'employee_id' => ['sometimes', 'exists:employees,id'],
            'assigned_at' => ['sometimes', 'date'],
            'is_primary' => ['sometimes', 'boolean'],
        ]);

        $attending_physician->update($data);

        return $attending_physician;
    }

    public function destroy(AttendingPhysician $attending_physician)
    {
        $attending_physician->delete();

        return response()->json(null, 204);
    }
}
