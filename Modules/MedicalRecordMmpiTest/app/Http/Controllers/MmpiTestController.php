<?php

namespace Modules\MedicalRecordMmpiTest\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordMmpiTest\Http\Requests\MmpiTestRequest;
use Modules\MedicalRecordMmpiTest\Http\Resources\MmpiTestResource;
use Modules\MedicalRecordMmpiTest\Models\MmpiTest;

class MmpiTestController extends Controller
{
    public function index(Request $request)
    {
        $query = MmpiTest::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return MmpiTestResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(MmpiTestRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $test = MmpiTest::create($data);

        return (new MmpiTestResource($test))->response()->setStatusCode(201);
    }

    public function show(MmpiTest $test): MmpiTestResource
    {
        return new MmpiTestResource($test);
    }

    public function update(MmpiTestRequest $request, MmpiTest $test): MmpiTestResource
    {
        $test->update($request->validated());

        return new MmpiTestResource($test);
    }

    public function destroy(MmpiTest $test)
    {
        $test->delete();

        return response()->json(['message' => 'MMPI test record deleted successfully']);
    }
}
