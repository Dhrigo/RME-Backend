<?php

namespace Modules\GeneralAntibioticBacteriaMapping\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralAntibioticBacteriaMapping\Models\AntibioticBacteriaMapping;

class AntibioticBacteriaMappingController extends Controller
{
    public function index(Request $request)
    {
        $query = AntibioticBacteriaMapping::query();

        if ($request->filled('antibiotic_name')) {
            $query->where('antibiotic_name', $request->string('antibiotic_name'));
        }

        return $query->orderBy('antibiotic_name')->paginate($request->integer('per_page', 15));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'antibiotic_name' => ['required', 'string', 'max:255'],
            'bacteria_name' => ['required', 'string', 'max:255'],
            'sensitivity_category' => ['nullable', 'string', Rule::in(AntibioticBacteriaMapping::SENSITIVITY_CATEGORIES)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['antibiotic_name'] = trim($data['antibiotic_name']);
        $data['bacteria_name'] = trim($data['bacteria_name']);

        $exists = AntibioticBacteriaMapping::query()
            ->where('antibiotic_name', $data['antibiotic_name'])
            ->where('bacteria_name', $data['bacteria_name'])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Kombinasi antibiotik dan bakteri sudah ada.'], 422);
        }

        return response()->json(AntibioticBacteriaMapping::create($data)->refresh(), 201);
    }

    public function show(AntibioticBacteriaMapping $antibiotic_bacteria_mapping): AntibioticBacteriaMapping
    {
        return $antibiotic_bacteria_mapping;
    }

    public function update(Request $request, AntibioticBacteriaMapping $antibiotic_bacteria_mapping): AntibioticBacteriaMapping
    {
        $data = $request->validate([
            'antibiotic_name' => ['sometimes', 'string', 'max:255'],
            'bacteria_name' => ['sometimes', 'string', 'max:255'],
            'sensitivity_category' => ['nullable', 'string', Rule::in(AntibioticBacteriaMapping::SENSITIVITY_CATEGORIES)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $antibiotic_bacteria_mapping->update($data);

        return $antibiotic_bacteria_mapping;
    }

    public function destroy(AntibioticBacteriaMapping $antibiotic_bacteria_mapping)
    {
        $antibiotic_bacteria_mapping->delete();

        return response()->json(null, 204);
    }
}
