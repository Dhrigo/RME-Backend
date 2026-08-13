<?php

namespace Modules\GeneralPackageItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPackageItem\Models\PackageItem;

class PackageItemController extends Controller
{
    public function index()
    {
        return PackageItem::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'package_id' => ['nullable', 'integer'],
            'item_id' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PackageItem::create($data)->refresh(), 201);
    }

    public function show(PackageItem $packageItem): PackageItem
    {
        return $packageItem;
    }

    public function update(Request $request, PackageItem $packageItem): PackageItem
    {
        $data = $request->validate([
            'package_id' => ['nullable', 'integer'],
            'item_id' => ['nullable', 'integer'],
            'quantity' => ['sometimes', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $packageItem->update($data);
        return $packageItem;
    }

    public function destroy(PackageItem $packageItem)
    {
        $packageItem->delete();
        return response()->json(null, 204);
    }
}
