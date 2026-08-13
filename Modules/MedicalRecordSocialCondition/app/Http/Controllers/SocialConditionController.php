<?php

namespace Modules\MedicalRecordSocialCondition\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordSocialCondition\Http\Requests\StoreSocialConditionRequest;
use Modules\MedicalRecordSocialCondition\Http\Requests\UpdateSocialConditionRequest;
use Modules\MedicalRecordSocialCondition\Http\Resources\SocialConditionResource;
use Modules\MedicalRecordSocialCondition\Models\SocialCondition;

class SocialConditionController extends Controller
{
    public function index(Request $request)
    {
        $query = SocialCondition::query();

        return SocialConditionResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSocialConditionRequest $request)
    {
        $data = $request->validated();

        $record = SocialCondition::create($data);

        return (new SocialConditionResource($record))->response()->setStatusCode(201);
    }

    public function show(SocialCondition $record): SocialConditionResource
    {
        return new SocialConditionResource($record);
    }

    public function update(UpdateSocialConditionRequest $request, SocialCondition $record): SocialConditionResource
    {
        $record->update($request->validated());

        return new SocialConditionResource($record);
    }

    public function destroy(SocialCondition $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
