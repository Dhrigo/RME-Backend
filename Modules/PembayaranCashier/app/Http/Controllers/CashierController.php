<?php

namespace Modules\PembayaranCashier\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\PembayaranCashier\Models\Cashier;

class CashierController extends Controller
{
    public function index()
    {
        return Cashier::query()->orderBy('cashier_code')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'cashier_code' => ['required', 'string', 'max:255', 'unique:cashiers,cashier_code'],
            'shift' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Cashier::create($data)->refresh(), 201);
    }

    public function show(Cashier $cashier): Cashier
    {
        return $cashier;
    }

    public function update(Request $request, Cashier $cashier): Cashier
    {
        $data = $request->validate([
            'employee_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'cashier_code' => ['sometimes', 'string', 'max:255', Rule::unique('cashiers', 'cashier_code')->ignore($cashier->id)],
            'shift' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $cashier->update($data);

        return $cashier;
    }

    public function destroy(Cashier $cashier)
    {
        $cashier->delete();

        return response()->json(null, 204);
    }
}
