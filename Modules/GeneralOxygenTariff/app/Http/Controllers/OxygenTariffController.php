<?php

namespace Modules\GeneralOxygenTariff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralOxygenTariff\Models\OxygenTariff;

class OxygenTariffController extends Controller
{
    public function index()
    {
        return OxygenTariff::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'oxygen_id' => ['nullable', 'integer'],
            'room_class_id' => ['nullable', 'integer'],
            'price' => ['required', 'numeric'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(OxygenTariff::create($data)->refresh(), 201);
    }

    public function show(OxygenTariff $oxygenTariff): OxygenTariff
    {
        return $oxygenTariff;
    }

    public function update(Request $request, OxygenTariff $oxygenTariff): OxygenTariff
    {
        $data = $request->validate([
            'oxygen_id' => ['nullable', 'integer'],
            'room_class_id' => ['nullable', 'integer'],
            'price' => ['sometimes', 'numeric'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $oxygenTariff->update($data);
        return $oxygenTariff;
    }

    public function destroy(OxygenTariff $oxygenTariff)
    {
        $oxygenTariff->delete();
        return response()->json(null, 204);
    }
}
