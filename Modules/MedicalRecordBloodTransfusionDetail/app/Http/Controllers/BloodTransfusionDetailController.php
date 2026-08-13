<?php

namespace Modules\MedicalRecordBloodTransfusionDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBloodTransfusionDetail\Http\Requests\BloodTransfusionDetailRequest;
use Modules\MedicalRecordBloodTransfusionDetail\Http\Resources\BloodTransfusionDetailResource;
use Modules\MedicalRecordBloodTransfusionDetail\Models\BloodTransfusionDetail;

class BloodTransfusionDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = BloodTransfusionDetail::query();

        if ($request->filled('transfusion_id')) {
            $query->where('transfusion_id', $request->integer('transfusion_id'));
        }

        return BloodTransfusionDetailResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(BloodTransfusionDetailRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $detail = BloodTransfusionDetail::create($data);

        return (new BloodTransfusionDetailResource($detail))->response()->setStatusCode(201);
    }

    public function show(BloodTransfusionDetail $detail): BloodTransfusionDetailResource
    {
        return new BloodTransfusionDetailResource($detail);
    }

    public function update(BloodTransfusionDetailRequest $request, BloodTransfusionDetail $detail): BloodTransfusionDetailResource
    {
        $detail->update($request->validated());

        return new BloodTransfusionDetailResource($detail);
    }

    public function destroy(BloodTransfusionDetail $detail)
    {
        $detail->delete();

        return response()->json(['message' => 'Blood transfusion detail deleted successfully']);
    }
}
