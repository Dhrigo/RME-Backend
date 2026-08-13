<?php

namespace Modules\GeneralKip\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralKip\Models\Kip;

class KipController extends Controller
{
    public function index()
    {
        return Kip::query()->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_norm' => ['required', 'string', 'max:255', Rule::unique('kips')->where('card_type', $request->input('card_type'))],
            'card_type' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'rt' => ['nullable', 'string', 'max:3'],
            'rw' => ['nullable', 'string', 'max:3'],
            'postal_code' => ['nullable', 'string', 'max:5'],
            'region_code' => ['nullable', 'string', 'max:10'],
        ]);

        return response()->json(Kip::create($data)->refresh(), 201);
    }

    public function show(Kip $kip): Kip
    {
        return $kip;
    }

    public function update(Request $request, Kip $kip): Kip
    {
        $data = $request->validate([
            'patient_norm' => ['sometimes', 'string', 'max:255', Rule::unique('kips')->where('card_type', $request->input('card_type', $kip->card_type))->ignore($kip->id)],
            'card_type' => ['sometimes', 'string', 'max:255'],
            'card_number' => ['sometimes', 'string', 'max:255'],
            'address' => ['sometimes', 'nullable', 'string', 'max:255'],
            'rt' => ['sometimes', 'nullable', 'string', 'max:3'],
            'rw' => ['sometimes', 'nullable', 'string', 'max:3'],
            'postal_code' => ['sometimes', 'nullable', 'string', 'max:5'],
            'region_code' => ['sometimes', 'nullable', 'string', 'max:10'],
        ]);

        $kip->update($data);

        return $kip;
    }

    public function destroy(Kip $kip)
    {
        $kip->delete();

        return response()->json(null, 204);
    }
}
