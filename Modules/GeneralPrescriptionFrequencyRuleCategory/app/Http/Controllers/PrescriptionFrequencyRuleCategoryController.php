<?php

namespace Modules\GeneralPrescriptionFrequencyRuleCategory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPrescriptionFrequencyRuleCategory\Http\Requests\StorePrescriptionFrequencyRuleCategoryRequest;
use Modules\GeneralPrescriptionFrequencyRuleCategory\Http\Requests\UpdatePrescriptionFrequencyRuleCategoryRequest;
use Modules\GeneralPrescriptionFrequencyRuleCategory\Http\Resources\PrescriptionFrequencyRuleCategoryResource;
use Modules\GeneralPrescriptionFrequencyRuleCategory\Models\PrescriptionFrequencyRuleCategory;

class PrescriptionFrequencyRuleCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = PrescriptionFrequencyRuleCategory::query();

        if ($request->filled('prescription_frequency_rule_id')) {
            $query->where('prescription_frequency_rule_id', $request->integer('prescription_frequency_rule_id'));
        }

        return PrescriptionFrequencyRuleCategoryResource::collection($query->orderBy('sort_order')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePrescriptionFrequencyRuleCategoryRequest $request)
    {
        $category = PrescriptionFrequencyRuleCategory::create($request->validated());

        return (new PrescriptionFrequencyRuleCategoryResource($category))->response()->setStatusCode(201);
    }

    public function show(PrescriptionFrequencyRuleCategory $freq_rule_category): PrescriptionFrequencyRuleCategoryResource
    {
        return new PrescriptionFrequencyRuleCategoryResource($freq_rule_category);
    }

    public function update(UpdatePrescriptionFrequencyRuleCategoryRequest $request, PrescriptionFrequencyRuleCategory $freq_rule_category): PrescriptionFrequencyRuleCategoryResource
    {
        $freq_rule_category->update($request->validated());

        return new PrescriptionFrequencyRuleCategoryResource($freq_rule_category);
    }

    public function destroy(PrescriptionFrequencyRuleCategory $freq_rule_category)
    {
        $freq_rule_category->delete();

        return response()->json(null, 204);
    }
}
