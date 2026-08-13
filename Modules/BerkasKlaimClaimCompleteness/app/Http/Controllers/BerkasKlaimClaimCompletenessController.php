<?php

namespace Modules\BerkasKlaimClaimCompleteness\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimClaimCompleteness\Models\ClaimCompleteness;

class BerkasKlaimClaimCompletenessController extends Controller
{
    public function index()
    {
        return ClaimCompleteness::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'claim_file_id' => ['required', 'exists:claim_files,id'],
            'checklist_item' => ['required', 'string', 'max:255'],
            'is_complete' => ['sometimes', 'boolean'],
            'checked_by' => ['nullable', 'string', 'max:255'],
            'checked_at' => ['nullable', 'date'],
        ]);

        return response()->json(ClaimCompleteness::create($data)->refresh(), 201);
    }

    public function show(ClaimCompleteness $claim_completeness)
    {
        return $claim_completeness;
    }

    public function update(Request $request, ClaimCompleteness $claim_completeness)
    {
        $data = $request->validate([
            'checklist_item' => ['sometimes', 'string', 'max:255'],
            'is_complete' => ['sometimes', 'boolean'],
            'checked_by' => ['nullable', 'string', 'max:255'],
            'checked_at' => ['nullable', 'date'],
        ]);

        $claim_completeness->update($data);

        return $claim_completeness;
    }

    public function destroy(ClaimCompleteness $claim_completeness)
    {
        $claim_completeness->delete();

        return response()->json(null, 204);
    }
}
