<?php

namespace Modules\BpjsICare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsICare\Services\ICareService;

/**
 * Thin passthrough controller for i-Care's "API Data Riwayat Pelayanan" - a client-only
 * lookup, no local persistence.
 */
class RiwayatPelayananController extends Controller
{
    public function __construct(private readonly ICareService $icare)
    {
    }

    public function validate(Request $request)
    {
        $data = $request->validate([
            'param' => ['required', 'string'],
            'kodedokter' => ['required'],
        ]);

        return response()->json($this->icare->validate($data['param'], $data['kodedokter']));
    }
}
