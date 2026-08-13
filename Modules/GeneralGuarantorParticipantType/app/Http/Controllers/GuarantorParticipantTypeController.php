<?php

namespace Modules\GeneralGuarantorParticipantType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralGuarantorParticipantType\Models\GuarantorParticipantType;

class GuarantorParticipantTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = GuarantorParticipantType::query();

        if ($request->filled('payer_type')) {
            $query->where('payer_type', $request->string('payer_type'));
        }

        return $query->orderBy('name')->paginate($request->integer('per_page', 15));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:guarantor_participant_types,name'],
            'code' => ['nullable', 'string', 'max:20', 'unique:guarantor_participant_types,code'],
            'payer_type' => ['required', 'string', Rule::in(GuarantorParticipantType::PAYER_TYPES)],
            'requires_verification' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(GuarantorParticipantType::create($data)->refresh(), 201);
    }

    public function show(GuarantorParticipantType $guarantor_participant_type): GuarantorParticipantType
    {
        return $guarantor_participant_type;
    }

    public function update(Request $request, GuarantorParticipantType $guarantor_participant_type): GuarantorParticipantType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('guarantor_participant_types', 'name')->ignore($guarantor_participant_type->id)],
            'code' => ['nullable', 'string', 'max:20', Rule::unique('guarantor_participant_types', 'code')->ignore($guarantor_participant_type->id)],
            'payer_type' => ['sometimes', 'string', Rule::in(GuarantorParticipantType::PAYER_TYPES)],
            'requires_verification' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $guarantor_participant_type->update($data);

        return $guarantor_participant_type;
    }

    public function destroy(GuarantorParticipantType $guarantor_participant_type)
    {
        $guarantor_participant_type->delete();

        return response()->json(null, 204);
    }
}
