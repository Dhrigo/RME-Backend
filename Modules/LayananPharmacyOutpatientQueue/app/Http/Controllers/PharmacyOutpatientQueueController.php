<?php

namespace Modules\LayananPharmacyOutpatientQueue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPharmacyOutpatientQueue\Http\Requests\StorePharmacyOutpatientQueueRequest;
use Modules\LayananPharmacyOutpatientQueue\Http\Requests\UpdatePharmacyOutpatientQueueRequest;
use Modules\LayananPharmacyOutpatientQueue\Http\Resources\PharmacyOutpatientQueueResource;
use Modules\LayananPharmacyOutpatientQueue\Models\PharmacyOutpatientQueue;

class PharmacyOutpatientQueueController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyOutpatientQueue::query();

        return PharmacyOutpatientQueueResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyOutpatientQueueRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'waiting';
        $queue = PharmacyOutpatientQueue::create($data);

        return (new PharmacyOutpatientQueueResource($queue))->response()->setStatusCode(201);
    }

    public function show(PharmacyOutpatientQueue $queue): PharmacyOutpatientQueueResource
    {
        return new PharmacyOutpatientQueueResource($queue);
    }

    public function update(UpdatePharmacyOutpatientQueueRequest $request, PharmacyOutpatientQueue $queue): PharmacyOutpatientQueueResource
    {
        $queue->update($request->validated());

        return new PharmacyOutpatientQueueResource($queue);
    }
}
