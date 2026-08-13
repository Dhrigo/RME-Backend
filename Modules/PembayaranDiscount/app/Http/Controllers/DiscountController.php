<?php

namespace Modules\PembayaranDiscount\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\PembayaranDiscount\Models\Discount;

class DiscountController extends Controller
{
    public function index()
    {
        return Discount::query()->orderBy('code')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:discounts,code'],
            'name' => ['required', 'string', 'max:255'],
            'discount_type' => ['required', 'string', 'in:' . implode(',', Discount::DISCOUNT_TYPES)],
            'value' => ['required', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Discount::create($data)->refresh(), 201);
    }

    public function show(Discount $discount): Discount
    {
        return $discount;
    }

    public function update(Request $request, Discount $discount): Discount
    {
        $data = $request->validate([
            'code' => ['sometimes', 'string', 'max:255', Rule::unique('discounts', 'code')->ignore($discount->id)],
            'name' => ['sometimes', 'string', 'max:255'],
            'discount_type' => ['sometimes', 'string', 'in:' . implode(',', Discount::DISCOUNT_TYPES)],
            'value' => ['sometimes', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $discount->update($data);

        return $discount;
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return response()->json(null, 204);
    }
}
