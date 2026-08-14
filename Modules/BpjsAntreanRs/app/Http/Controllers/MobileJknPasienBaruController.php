<?php

namespace Modules\BpjsAntreanRs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * "Info Pasien Baru" — best-effort guess: Mobile JKN submits new-patient
 * registration info before booking; forwarded to BPJS's referensi endpoint
 * is not documented here, so this is stored/returned as an acknowledgement
 * only. Field shape and behavior not confirmed — flagged for review.
 */
class MobileJknPasienBaruController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => ['required', 'string', 'max:20'],
            'nama' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string', 'in:L,P'],
            'alamat' => ['nullable', 'string'],
        ]);

        return response()->json([
            'response' => $data,
            'metadata' => ['message' => 'Ok', 'code' => 200],
        ], 201);
    }
}
