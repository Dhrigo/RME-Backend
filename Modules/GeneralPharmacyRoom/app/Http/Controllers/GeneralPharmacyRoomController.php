<?php

namespace Modules\GeneralPharmacyRoom\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPharmacyRoom\Models\PharmacyRoom;

class GeneralPharmacyRoomController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyRoom::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return $query->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'pharmacy_type' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PharmacyRoom::create($data)->refresh(), 201);
    }

    public function show(PharmacyRoom $pharmacyRoom): PharmacyRoom
    {
        return $pharmacyRoom;
    }

    public function update(Request $request, PharmacyRoom $pharmacyRoom): PharmacyRoom
    {
        $data = $request->validate([
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'pharmacy_type' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $pharmacyRoom->update($data);

        return $pharmacyRoom;
    }

    public function destroy(PharmacyRoom $pharmacyRoom)
    {
        $pharmacyRoom->delete();

        return response()->json(null, 204);
    }
}
