<?php

namespace Modules\PendaftaranWardQueue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranWardQueue\Http\Requests\StoreWardQueueRequest;
use Modules\PendaftaranWardQueue\Http\Requests\UpdateWardQueueRequest;
use Modules\PendaftaranWardQueue\Http\Resources\WardQueueResource;
use Modules\PendaftaranWardQueue\Models\WardQueue;

class WardQueueController extends Controller
{
    public function index(Request $request)
    {
        $query = WardQueue::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return WardQueueResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreWardQueueRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'waiting';

        $queue = WardQueue::create($data);

        return (new WardQueueResource($queue))->response()->setStatusCode(201);
    }

    public function show(WardQueue $wardQueue): WardQueueResource
    {
        return new WardQueueResource($wardQueue);
    }

    public function update(UpdateWardQueueRequest $request, WardQueue $wardQueue): WardQueueResource
    {
        $data = $request->validated();
        if ($data['status'] === 'called' && ! $wardQueue->called_at) {
            $data['called_at'] = now();
        }

        $wardQueue->update($data);

        return new WardQueueResource($wardQueue);
    }
}
