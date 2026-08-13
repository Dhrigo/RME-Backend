<?php

namespace Modules\PendaftaranQueueCall\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranQueueCall\Http\Requests\StoreQueueCallRequest;
use Modules\PendaftaranQueueCall\Http\Resources\QueueCallResource;
use Modules\PendaftaranQueueCall\Models\QueueCall;

class QueueCallController extends Controller
{
    public function index(Request $request)
    {
        $query = QueueCall::query();

        if ($request->filled('ward_queue_id')) {
            $query->where('ward_queue_id', $request->integer('ward_queue_id'));
        }

        return QueueCallResource::collection($query->latest('called_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * A queue call is a paging-history event log - append-only, no update/delete.
     */
    public function store(StoreQueueCallRequest $request)
    {
        $data = $request->validated();
        $data['called_at'] = now();
        $data['called_by'] = $request->user()->id;

        $call = QueueCall::create($data);

        return (new QueueCallResource($call))->response()->setStatusCode(201);
    }

    public function show(QueueCall $queueCall): QueueCallResource
    {
        return new QueueCallResource($queueCall);
    }
}
