<?php

namespace Modules\GeneralKap\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralKap\Models\Kap;

class KapController extends Controller
{
    public function index()
    {
        return Kap::query()->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_norm' => ['required', 'string', 'max:255', Rule::unique('kaps')->where('card_type', $request->input('card_type'))],
            'card_type' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'max:255'],
        ]);

        return response()->json(Kap::create($data)->refresh(), 201);
    }

    public function show(Kap $kap): Kap
    {
        return $kap;
    }

    public function update(Request $request, Kap $kap): Kap
    {
        $data = $request->validate([
            'patient_norm' => ['sometimes', 'string', 'max:255', Rule::unique('kaps')->where('card_type', $request->input('card_type', $kap->card_type))->ignore($kap->id)],
            'card_type' => ['sometimes', 'string', 'max:255'],
            'card_number' => ['sometimes', 'string', 'max:255'],
        ]);

        $kap->update($data);

        return $kap;
    }

    public function destroy(Kap $kap)
    {
        $kap->delete();

        return response()->json(null, 204);
    }
}
