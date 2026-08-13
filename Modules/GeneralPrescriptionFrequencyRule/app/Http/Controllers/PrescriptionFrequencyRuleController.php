<?php

namespace Modules\GeneralPrescriptionFrequencyRule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPrescriptionFrequencyRule\Http\Requests\StorePrescriptionFrequencyRuleRequest;
use Modules\GeneralPrescriptionFrequencyRule\Http\Requests\UpdatePrescriptionFrequencyRuleRequest;
use Modules\GeneralPrescriptionFrequencyRule\Http\Resources\PrescriptionFrequencyRuleResource;
use Modules\GeneralPrescriptionFrequencyRule\Models\PrescriptionFrequencyRule;

class PrescriptionFrequencyRuleController extends Controller
{
    public function index(Request $request)
    {
        $query = PrescriptionFrequencyRule::query();

        if ($request->filled('code')) {
            $query->where('code', $request->string('code'));
        }

        return PrescriptionFrequencyRuleResource::collection($query->orderBy('code')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePrescriptionFrequencyRuleRequest $request)
    {
        $rule = PrescriptionFrequencyRule::create($request->validated());

        return (new PrescriptionFrequencyRuleResource($rule))->response()->setStatusCode(201);
    }

    public function show(PrescriptionFrequencyRule $prescription_frequency_rule): PrescriptionFrequencyRuleResource
    {
        return new PrescriptionFrequencyRuleResource($prescription_frequency_rule);
    }

    public function update(UpdatePrescriptionFrequencyRuleRequest $request, PrescriptionFrequencyRule $prescription_frequency_rule): PrescriptionFrequencyRuleResource
    {
        $prescription_frequency_rule->update($request->validated());

        return new PrescriptionFrequencyRuleResource($prescription_frequency_rule);
    }

    public function destroy(PrescriptionFrequencyRule $prescription_frequency_rule)
    {
        $prescription_frequency_rule->delete();

        return response()->json(null, 204);
    }
}
