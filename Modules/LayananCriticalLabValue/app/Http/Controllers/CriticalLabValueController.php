<?php

namespace Modules\LayananCriticalLabValue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananCriticalLabValue\Http\Requests\StoreCriticalLabValueRequest;
use Modules\LayananCriticalLabValue\Http\Requests\UpdateCriticalLabValueRequest;
use Modules\LayananCriticalLabValue\Http\Resources\CriticalLabValueResource;
use Modules\LayananCriticalLabValue\Models\CriticalLabValue;

class CriticalLabValueController extends Controller
{
    public function index(Request $request)
    {
        $query = CriticalLabValue::query();

        return CriticalLabValueResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreCriticalLabValueRequest $request)
    {
        $data = $request->validated();
        $data['acknowledged'] = $data['acknowledged'] ?? false;
        $critical_value = CriticalLabValue::create($data);

        return (new CriticalLabValueResource($critical_value))->response()->setStatusCode(201);
    }

    public function show(CriticalLabValue $critical_value): CriticalLabValueResource
    {
        return new CriticalLabValueResource($critical_value);
    }

    public function update(UpdateCriticalLabValueRequest $request, CriticalLabValue $critical_value): CriticalLabValueResource
    {
        $critical_value->update($request->validated());

        return new CriticalLabValueResource($critical_value);
    }
}
