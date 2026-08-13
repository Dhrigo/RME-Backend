<?php

namespace Modules\InventoryItemClassification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\InventoryItemClassification\Models\ItemClassification;

class InventoryItemClassificationController extends Controller
{
    public function index()
    {
        return ItemClassification::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:item_classifications,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:item_classifications,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ItemClassification::create($data)->refresh(), 201);
    }

    public function show(ItemClassification $inventoryitemclassification): ItemClassification
    {
        return $inventoryitemclassification;
    }

    public function update(Request $request, ItemClassification $inventoryitemclassification): ItemClassification
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('item_classifications', 'name')->ignore($inventoryitemclassification->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('item_classifications', 'code')->ignore($inventoryitemclassification->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $inventoryitemclassification->update($data);

        return $inventoryitemclassification;
    }

    public function destroy(ItemClassification $inventoryitemclassification)
    {
        $inventoryitemclassification->delete();

        return response()->json(null, 204);
    }
}
