<?php
namespace Modules\PembatalanReturnCancellation\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanReturnCancellation\Models\ReturnCancellation;
class PembatalanReturnCancellationController extends Controller {
    public function index() {
        return ReturnCancellation::query()->paginate(15);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'return_id' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string'],
            'cancellation_date' => ['required', 'date'],
            'requested_by' => ['required', 'string', 'max:255'],
            'status' => ['sometimes', 'string'],
        ]);
        $data['cancellation_number'] = ReturnCancellation::generateCancellationNumber();
        return response()->json(ReturnCancellation::create($data)->refresh(), 201);
    }
    public function show(ReturnCancellation $return_cancellation) {
        return $return_cancellation;
    }
    public function update(Request $request, ReturnCancellation $return_cancellation) {
        $data = $request->validate([
            'reason' => ['sometimes', 'string'],
            'cancellation_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string'],
        ]);
        $return_cancellation->update($data);
        return $return_cancellation;
    }
    public function destroy(ReturnCancellation $return_cancellation) {
        $return_cancellation->delete();
        return response()->json(null, 204);
    }
}
