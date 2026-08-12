<?php

namespace Modules\GeneralDiagnosisCode\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;

class DiagnosisCodeController extends Controller
{
    public function index(Request $request)
    {
        $query = DiagnosisCode::query();

        if ($request->filled('search')) {
            $term = $request->string('search');
            $query->where(fn ($q) => $q->where('code', 'like', "%{$term}%")->orWhere('name', 'like', "%{$term}%"));
        }

        return $query->orderBy('code')->paginate($request->integer('per_page', 15));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:diagnosis_codes,code'],
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(DiagnosisCode::create($data)->refresh(), 201);
    }

    public function show(DiagnosisCode $diagnosis_code): DiagnosisCode
    {
        return $diagnosis_code;
    }

    public function update(Request $request, DiagnosisCode $diagnosis_code): DiagnosisCode
    {
        $data = $request->validate([
            'code' => ['sometimes', 'string', 'max:255', Rule::unique('diagnosis_codes', 'code')->ignore($diagnosis_code->id)],
            'name' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $diagnosis_code->update($data);

        return $diagnosis_code;
    }

    public function destroy(DiagnosisCode $diagnosis_code)
    {
        $diagnosis_code->delete();

        return response()->json(null, 204);
    }
}
