<?php

namespace Modules\SirsOnlineBor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SirsOnlineBor\Models\TempatTidur;
use Modules\SirsOnlineBor\Services\SirsOnlineBorService;

class SirsOnlineBorController extends Controller
{
    public function __construct(private readonly SirsOnlineBorService $service)
    {
    }

    public function index(Request $request)
    {
        return TempatTidur::query()->latest()->paginate($request->integer('per_page', 15));
    }

    public function show(TempatTidur $tempatTidur)
    {
        return $tempatTidur;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_tt' => ['required'],
            'ruang' => ['required'],
            'jumlah_ruang' => ['nullable'],
            'jumlah' => ['nullable'],
            'terpakai' => ['nullable'],
            'terpakai_suspek' => ['nullable'],
            'terpakai_konfirmasi' => ['nullable'],
            'antrian' => ['nullable'],
            'prepare' => ['nullable'],
            'prepare_plan' => ['nullable'],
            'covid' => ['nullable'],
            'terpakai_dbd' => ['nullable'],
            'terpakai_dbd_anak' => ['nullable'],
            'jumlah_dbd' => ['nullable'],
        ]);

        return response()->json($this->service->create($validated))->setStatusCode(201);
    }

    public function update(Request $request, TempatTidur $tempatTidur)
    {
        return response()->json($this->service->update($tempatTidur, $request->all()));
    }

    public function destroy(TempatTidur $tempatTidur)
    {
        $this->service->delete($tempatTidur);

        return response()->json(['message' => 'Tempat tidur deleted']);
    }
}
