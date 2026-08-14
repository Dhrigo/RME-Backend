<?php

namespace Modules\RsOnline\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\RsOnline\Models\RsOnlineSubmission;
use Modules\RsOnline\Services\RsOnlineService;

class RsOnlineController extends Controller
{
    public function __construct(private readonly RsOnlineService $service)
    {
    }

    public function index(Request $request)
    {
        $query = RsOnlineSubmission::query();
        if ($request->filled('resource')) {
            $query->where('resource', $request->string('resource'));
        }

        return $query->latest()->paginate($request->integer('per_page', 15));
    }

    public function show(RsOnlineSubmission $rsOnlineSubmission)
    {
        return $rsOnlineSubmission;
    }

    public function pushSdm(Request $request)
    {
        return response()->json($this->service->pushSdm($request->all(), $request->query('id')))->setStatusCode(201);
    }

    public function pushLayanan(Request $request)
    {
        return response()->json($this->service->pushLayanan($request->all(), $request->query('id')))->setStatusCode(201);
    }

    public function pushAlkes(Request $request)
    {
        return response()->json($this->service->pushAlkes($request->all(), $request->query('alkes_data_id')))->setStatusCode(201);
    }

    public function pushTempatTidur(Request $request)
    {
        return response()->json($this->service->pushTempatTidur($request->all(), $request->query('id')))->setStatusCode(201);
    }

    public function storeRegistrasiUser(Request $request)
    {
        return response()->json($this->service->registrasiUser($request->all()))->setStatusCode(201);
    }

    public function updateRegistrasiUser(Request $request, string $id)
    {
        return response()->json($this->service->updateRegistrasiUser($id, $request->all()));
    }

    public function destroyRegistrasiUser(string $id)
    {
        return response()->json($this->service->deleteRegistrasiUser($id));
    }
}
