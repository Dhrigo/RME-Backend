<?php

namespace Modules\InventoryItemCategory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\InventoryItemCategory\Models\ItemCategory;

class InventoryItemCategoryController extends Controller
{
    public function index()
    {
        return ItemCategory::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:item_categories,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:item_categories,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ItemCategory::create($data)->refresh(), 201);
    }

    public function show(ItemCategory $inventoryitemcategory): ItemCategory
    {
        return $inventoryitemcategory;
    }

    public function update(Request $request, ItemCategory $inventoryitemcategory): ItemCategory
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('item_categories', 'name')->ignore($inventoryitemcategory->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('item_categories', 'code')->ignore($inventoryitemcategory->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $inventoryitemcategory->update($data);

        return $inventoryitemcategory;
    }

    public function destroy(ItemCategory $inventoryitemcategory)
    {
        $inventoryitemcategory->delete();

        return response()->json(null, 204);
    }
}
