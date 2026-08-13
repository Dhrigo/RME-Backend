<?php

namespace Modules\PendaftaranCoManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranCoManagement\Http\Requests\StoreCoManagementRequest;
use Modules\PendaftaranCoManagement\Http\Resources\CoManagementResource;
use Modules\PendaftaranCoManagement\Models\CoManagement;

class CoManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = CoManagement::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return CoManagementResource::collection($query->latest('started_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreCoManagementRequest $request)
    {
        $data = $request->validated();
        $data['started_at'] ??= now();

        $comanagement = CoManagement::create($data);

        return (new CoManagementResource($comanagement))->response()->setStatusCode(201);
    }

    public function show(CoManagement $comanagement): CoManagementResource
    {
        return new CoManagementResource($comanagement);
    }
}
