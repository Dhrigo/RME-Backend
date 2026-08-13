<?php

namespace Modules\PendaftaranHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranHistory\Http\Requests\StoreRegistrationHistoryRequest;
use Modules\PendaftaranHistory\Http\Resources\RegistrationHistoryResource;
use Modules\PendaftaranHistory\Models\RegistrationHistory;

class PendaftaranHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = RegistrationHistory::query();

        if ($request->filled('registration_id')) {
            $query->where('registration_id', $request->integer('registration_id'));
        }

        return RegistrationHistoryResource::collection($query->latest('changed_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * History entries are append-only, same as MedicalRecordVitalSign - a status
     * correction is a new entry, not an edit of a past one.
     */
    public function store(StoreRegistrationHistoryRequest $request)
    {
        $data = $request->validated();
        $data['changed_at'] ??= now();
        $data['changed_by'] = $request->user()->id;

        $history = RegistrationHistory::create($data);

        return (new RegistrationHistoryResource($history))->response()->setStatusCode(201);
    }

    public function show(RegistrationHistory $history): RegistrationHistoryResource
    {
        return new RegistrationHistoryResource($history);
    }
}
