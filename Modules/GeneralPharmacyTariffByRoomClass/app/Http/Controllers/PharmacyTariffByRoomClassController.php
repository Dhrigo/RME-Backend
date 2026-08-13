<?php

namespace Modules\GeneralPharmacyTariffByRoomClass\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPharmacyTariffByRoomClass\Models\PharmacyTariffByRoomClass;

class PharmacyTariffByRoomClassController extends Controller
{
    public function index()
    {
        return PharmacyTariffByRoomClass::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => ['nullable', 'integer'],
            'room_class_id' => ['nullable', 'integer'],
            'price' => ['required', 'numeric'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PharmacyTariffByRoomClass::create($data)->refresh(), 201);
    }

    public function show(PharmacyTariffByRoomClass $pharmacyTariffByRoomClass): PharmacyTariffByRoomClass
    {
        return $pharmacyTariffByRoomClass;
    }

    public function update(Request $request, PharmacyTariffByRoomClass $pharmacyTariffByRoomClass): PharmacyTariffByRoomClass
    {
        $data = $request->validate([
            'item_id' => ['nullable', 'integer'],
            'room_class_id' => ['nullable', 'integer'],
            'price' => ['sometimes', 'numeric'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $pharmacyTariffByRoomClass->update($data);
        return $pharmacyTariffByRoomClass;
    }

    public function destroy(PharmacyTariffByRoomClass $pharmacyTariffByRoomClass)
    {
        $pharmacyTariffByRoomClass->delete();
        return response()->json(null, 204);
    }
}
