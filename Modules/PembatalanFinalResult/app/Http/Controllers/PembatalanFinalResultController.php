<?php
namespace Modules\PembatalanFinalResult\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanFinalResult\Models\FinalResult;
class PembatalanFinalResultController extends Controller {
    public function index() {
        return FinalResult::query()->paginate(15);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'visit_id' => ['required', 'exists:visits,id'],
            'reason' => ['required', 'string'],
            'cancellation_date' => ['required', 'date'],
            'requested_by' => ['required', 'string', 'max:255'],
            'status' => ['sometimes', 'string'],
        ]);
        $data['cancellation_number'] = FinalResult::generateCancellationNumber();
        return response()->json(FinalResult::create($data)->refresh(), 201);
    }
    public function show(FinalResult $final_result) {
        return $final_result;
    }
    public function update(Request $request, FinalResult $final_result) {
        $data = $request->validate([
            'reason' => ['sometimes', 'string'],
            'cancellation_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string'],
        ]);
        $final_result->update($data);
        return $final_result;
    }
    public function destroy(FinalResult $final_result) {
        $final_result->delete();
        return response()->json(null, 204);
    }
}
