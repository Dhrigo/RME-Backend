<?php

namespace Modules\LayananLabMicroscopicResultItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabMicroscopicResultItem\Http\Requests\StoreLabMicroscopicResultItemRequest;
use Modules\LayananLabMicroscopicResultItem\Http\Resources\LabMicroscopicResultItemResource;
use Modules\LayananLabMicroscopicResultItem\Models\LabMicroscopicResultItem;

class LabMicroscopicResultItemController extends Controller
{
    public function index(Request $request)
    {
        $query = LabMicroscopicResultItem::query();

        return LabMicroscopicResultItemResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabMicroscopicResultItemRequest $request)
    {
        $data = $request->validated();

        $microscopic_item = LabMicroscopicResultItem::create($data);

        return (new LabMicroscopicResultItemResource($microscopic_item))->response()->setStatusCode(201);
    }

    public function show(LabMicroscopicResultItem $microscopic_item): LabMicroscopicResultItemResource
    {
        return new LabMicroscopicResultItemResource($microscopic_item);
    }
}
