<?php
namespace Modules\PembatalanMedicalRecordCancellation\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanMedicalRecordCancellation\Models\MedicalRecordCancellation;
class PembatalanMedicalRecordCancellationController extends Controller {
    public function index() {
        return MedicalRecordCancellation::query()->paginate(15);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'medical_record_id' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string'],
            'cancellation_date' => ['required', 'date'],
            'requested_by' => ['required', 'string', 'max:255'],
            'status' => ['sometimes', 'string'],
        ]);
        $data['cancellation_number'] = MedicalRecordCancellation::generateCancellationNumber();
        return response()->json(MedicalRecordCancellation::create($data)->refresh(), 201);
    }
    public function show(MedicalRecordCancellation $medical_record_cancellation) {
        return $medical_record_cancellation;
    }
    public function update(Request $request, MedicalRecordCancellation $medical_record_cancellation) {
        $data = $request->validate([
            'reason' => ['sometimes', 'string'],
            'cancellation_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string'],
        ]);
        $medical_record_cancellation->update($data);
        return $medical_record_cancellation;
    }
    public function destroy(MedicalRecordCancellation $medical_record_cancellation) {
        $medical_record_cancellation->delete();
        return response()->json(null, 204);
    }
}
