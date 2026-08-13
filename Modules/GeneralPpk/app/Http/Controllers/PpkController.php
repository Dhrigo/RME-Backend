<?php

namespace Modules\GeneralPpk\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPpk\Models\Ppk;

class PpkController extends Controller
{
    public function index()
    {
        return Ppk::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        return response()->json(Ppk::create($data)->refresh(), 201);
    }

    public function show(Ppk $ppk): Ppk
    {
        return $ppk;
    }

    public function update(Request $request, Ppk $ppk): Ppk
    {
        $rules = $this->rules($ppk->id);
        foreach (['name', 'class', 'address', 'fax', 'region_name'] as $required) {
            $rules[$required][0] = 'sometimes';
        }

        $data = $request->validate($rules);

        $ppk->update($data);

        return $ppk;
    }

    public function destroy(Ppk $ppk)
    {
        $ppk->delete();

        return response()->json(null, 204);
    }

    private function rules(?int $ignoreId = null): array
    {
        return [
            'code' => ['nullable', 'string', 'max:10', Rule::unique('ppks', 'code')->ignore($ignoreId)],
            'bpjs_code' => ['nullable', 'string', 'max:8'],
            'type' => ['nullable', 'integer'],
            'ownership' => ['nullable', 'integer'],
            'jpk' => ['nullable', 'integer'],
            'name' => ['required', 'string', 'max:75'],
            'class' => ['required', 'string', 'max:1'],
            'address' => ['required', 'string', 'max:150'],
            'rt' => ['nullable', 'string', 'max:3'],
            'rw' => ['nullable', 'string', 'max:3'],
            'postal_code' => ['nullable', 'string', 'max:5'],
            'phone' => ['nullable', 'string', 'max:25'],
            'fax' => ['required', 'string', 'max:25'],
            'region_code' => ['nullable', 'string', 'max:10'],
            'region_name' => ['required', 'string'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
