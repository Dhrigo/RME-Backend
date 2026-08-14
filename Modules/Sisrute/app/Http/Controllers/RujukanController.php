<?php

namespace Modules\Sisrute\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Sisrute\Models\Rujukan;
use Modules\Sisrute\Services\SisruteService;

class RujukanController extends Controller
{
    public function __construct(private readonly SisruteService $service)
    {
    }

    public function index(Request $request)
    {
        $query = Rujukan::query();
        if ($request->filled('direction')) {
            $query->where('direction', $request->string('direction'));
        }

        return $query->latest()->paginate($request->integer('per_page', 15));
    }

    public function show(Rujukan $rujukan)
    {
        return $rujukan;
    }

    public function kirim(Request $request)
    {
        return response()->json($this->service->kirimRujukan($request->all()))->setStatusCode(201);
    }

    public function notif(Request $request)
    {
        return response()->json($this->service->notifRujukan($request->all()))->setStatusCode(201);
    }

    public function jawab(Request $request)
    {
        return response()->json($this->service->jawabRujukan($request->all()))->setStatusCode(201);
    }

    public function batal(Request $request)
    {
        return response()->json($this->service->batalRujukan($request->all()))->setStatusCode(201);
    }

    public function images(Request $request)
    {
        return response()->json($this->service->imagesRujukan($request->all()))->setStatusCode(201);
    }

    public function pasien(string $noRujukan)
    {
        return response()->json($this->service->pasienRujukan($noRujukan));
    }
}
