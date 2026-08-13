<?php

namespace Modules\GeneralAdministrationTariff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralAdministrationTariff\Models\AdministrationTariff;

class AdministrationTariffController extends Controller
{
    public function index()
    {
        return AdministrationTariff::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'administration_id' => ['nullable', 'integer'],
            'room_class_id' => ['nullable', 'integer'],
            'price' => ['required', 'numeric'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(AdministrationTariff::create($data)->refresh(), 201);
    }

    public function show(AdministrationTariff $administrationTariff): AdministrationTariff
    {
        return $administrationTariff;
    }

    public function update(Request $request, AdministrationTariff $administrationTariff): AdministrationTariff
    {
        $data = $request->validate([
            'administration_id' => ['nullable', 'integer'],
            'room_class_id' => ['nullable', 'integer'],
            'price' => ['sometimes', 'numeric'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $administrationTariff->update($data);
        return $administrationTariff;
    }

    public function destroy(AdministrationTariff $administrationTariff)
    {
        $administrationTariff->delete();
        return response()->json(null, 204);
    }
}
