<?php

namespace Modules\PenjaminRSClaimDriver\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\PenjaminRSClaimDriver\Models\ClaimDriver;

class PenjaminRSClaimDriverController extends Controller
{
    public function index()
    {
        return ClaimDriver::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:claim_drivers,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ClaimDriver::create($data)->refresh(), 201);
    }

    public function show(ClaimDriver $claim_driver)
    {
        return $claim_driver;
    }

    public function update(Request $request, ClaimDriver $claim_driver)
    {
        $data = $request->validate([
            'code' => ['sometimes', 'string', 'max:20', Rule::unique('claim_drivers', 'code')->ignore($claim_driver->id)],
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $claim_driver->update($data);

        return $claim_driver;
    }

    public function destroy(ClaimDriver $claim_driver)
    {
        $claim_driver->delete();

        return response()->json(null, 204);
    }
}
