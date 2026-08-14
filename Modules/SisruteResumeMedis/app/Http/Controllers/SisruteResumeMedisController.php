<?php

namespace Modules\SisruteResumeMedis\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SisruteResumeMedis\Services\ResumeMedisService;

class SisruteResumeMedisController extends Controller
{
    public function __construct(private readonly ResumeMedisService $service)
    {
    }

    public function index(Request $request)
    {
        return response()->json($this->service->get($request->query()));
    }

    public function store(Request $request)
    {
        return response()->json($this->service->send($request->all()))->setStatusCode(201);
    }
}
