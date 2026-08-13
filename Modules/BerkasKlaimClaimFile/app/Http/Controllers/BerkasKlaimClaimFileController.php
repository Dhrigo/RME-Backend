<?php

namespace Modules\BerkasKlaimClaimFile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;

class BerkasKlaimClaimFileController extends Controller
{
    public function index()
    {
        return ClaimFile::query()->latest()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'visit_id' => ['required', 'exists:visits,id'],
            'invoice_id' => ['nullable', 'exists:invoices,id'],
            'status' => ['sometimes', 'string'],
        ]);

        $data['claim_number'] = ClaimFile::generateClaimNumber();

        return response()->json(ClaimFile::create($data)->refresh(), 201);
    }

    public function show(ClaimFile $claim_file)
    {
        return $claim_file;
    }

    public function update(Request $request, ClaimFile $claim_file)
    {
        $data = $request->validate([
            'invoice_id' => ['nullable', 'exists:invoices,id'],
            'submitted_at' => ['nullable', 'date'],
            'status' => ['sometimes', 'string'],
        ]);

        $claim_file->update($data);

        return $claim_file;
    }

    public function destroy(ClaimFile $claim_file)
    {
        $claim_file->delete();

        return response()->json(null, 204);
    }
}
