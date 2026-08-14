<?php

namespace Modules\Sitb\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Sitb\Models\PasienTb;
use Modules\Sitb\Services\SitbService;

class SitbController extends Controller
{
    public function __construct(private readonly SitbService $service)
    {
    }

    public function index(Request $request)
    {
        $query = PasienTb::query();
        if ($request->filled('kirim')) {
            $query->where('kirim', $request->integer('kirim'));
        }

        return $query->latest()->paginate($request->integer('per_page', 15));
    }

    public function show(PasienTb $pasienTb)
    {
        return $pasienTb;
    }

    public function store(Request $request)
    {
        $pasienTb = PasienTb::create($request->all() + ['kirim' => 1, 'oleh' => auth()->id()]);

        return response()->json($this->service->kirim($pasienTb))->setStatusCode(201);
    }

    public function update(Request $request, PasienTb $pasienTb)
    {
        // Source: any update re-queues the row for resend (kirim = 1).
        $pasienTb->fill($request->all());
        $pasienTb->kirim = 1;
        $pasienTb->save();

        return response()->json($this->service->kirim($pasienTb));
    }
}
