<?php

namespace Modules\GeneralProcedure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralProcedure\Models\Procedure;

class ProcedureController extends Controller
{
    public function index()
    {
        return Procedure::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['nullable', 'string', 'max:50', 'unique:procedures,code'],
            'name' => ['required', 'string', 'max:255', 'unique:procedures,name'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Procedure::create($data)->refresh(), 201);
    }

    public function show(Procedure $procedure): Procedure
    {
        return $procedure;
    }

    public function update(Request $request, Procedure $procedure): Procedure
    {
        $data = $request->validate([
            'code' => ['nullable', 'string', 'max:50', \Illuminate\Validation\Rule::unique('procedures', 'code')->ignore($procedure->id)],
            'name' => ['sometimes', 'string', 'max:255', \Illuminate\Validation\Rule::unique('procedures', 'name')->ignore($procedure->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $procedure->update($data);
        return $procedure;
    }

    public function destroy(Procedure $procedure)
    {
        $procedure->delete();
        return response()->json(null, 204);
    }
}
