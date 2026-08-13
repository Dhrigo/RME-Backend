<?php

namespace Modules\PembayaranDoctorDiscount\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranDoctorDiscount\Models\DoctorDiscount;

class DoctorDiscountController extends Controller
{
    public function index()
    {
        return DoctorDiscount::query()->latest()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'discount_id' => ['required', 'integer', 'exists:discounts,id'],
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'percentage' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        return response()->json(DoctorDiscount::create($data)->refresh(), 201);
    }

    public function show(DoctorDiscount $doctor_discount): DoctorDiscount
    {
        return $doctor_discount;
    }

    public function update(Request $request, DoctorDiscount $doctor_discount): DoctorDiscount
    {
        $data = $request->validate([
            'discount_id' => ['sometimes', 'integer', 'exists:discounts,id'],
            'employee_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'percentage' => ['sometimes', 'numeric', 'min:0', 'max:100'],
        ]);

        $doctor_discount->update($data);

        return $doctor_discount;
    }

    public function destroy(DoctorDiscount $doctor_discount)
    {
        $doctor_discount->delete();

        return response()->json(null, 204);
    }
}
