<?php

namespace Modules\GeneralWardTariff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralWardTariff\Models\WardTariff;

class WardTariffController extends Controller
{
    public function index()
    {
        return WardTariff::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ward_id' => ['nullable', 'integer'],
            'room_class_id' => ['nullable', 'integer'],
            'price' => ['required', 'numeric'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(WardTariff::create($data)->refresh(), 201);
    }

    public function show(WardTariff $wardTariff): WardTariff
    {
        return $wardTariff;
    }

    public function update(Request $request, WardTariff $wardTariff): WardTariff
    {
        $data = $request->validate([
            'ward_id' => ['nullable', 'integer'],
            'room_class_id' => ['nullable', 'integer'],
            'price' => ['sometimes', 'numeric'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $wardTariff->update($data);
        return $wardTariff;
    }

    public function destroy(WardTariff $wardTariff)
    {
        $wardTariff->delete();
        return response()->json(null, 204);
    }
}
