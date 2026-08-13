<?php

namespace Modules\BerkasKlaimClaimCompletenessComment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimClaimCompletenessComment\Models\ClaimCompletenessComment;

class BerkasKlaimClaimCompletenessCommentController extends Controller
{
    public function index()
    {
        return ClaimCompletenessComment::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'claim_completeness_id' => ['required', 'exists:claim_completeness,id'],
            'comment' => ['required', 'string'],
            'commented_by' => ['nullable', 'string', 'max:255'],
            'commented_at' => ['nullable', 'date'],
        ]);

        return response()->json(ClaimCompletenessComment::create($data)->refresh(), 201);
    }

    public function show(ClaimCompletenessComment $claim_completeness_comment)
    {
        return $claim_completeness_comment;
    }

    public function update(Request $request, ClaimCompletenessComment $claim_completeness_comment)
    {
        $data = $request->validate([
            'comment' => ['sometimes', 'string'],
            'commented_by' => ['nullable', 'string', 'max:255'],
            'commented_at' => ['nullable', 'date'],
        ]);

        $claim_completeness_comment->update($data);

        return $claim_completeness_comment;
    }

    public function destroy(ClaimCompletenessComment $claim_completeness_comment)
    {
        $claim_completeness_comment->delete();

        return response()->json(null, 204);
    }
}
