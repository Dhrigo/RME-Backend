<?php

namespace Modules\GeneralAudioAttachment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralAudioAttachment\Http\Requests\StoreAudioAttachmentRequest;
use Modules\GeneralAudioAttachment\Http\Requests\UpdateAudioAttachmentRequest;
use Modules\GeneralAudioAttachment\Http\Resources\AudioAttachmentResource;
use Modules\GeneralAudioAttachment\Models\AudioAttachment;

class AudioAttachmentController extends Controller
{
    public function index(Request $request)
    {
        $query = AudioAttachment::query();

        return AudioAttachmentResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAudioAttachmentRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $audio_attachment = AudioAttachment::create($data);

        return (new AudioAttachmentResource($audio_attachment))->response()->setStatusCode(201);
    }

    public function show(AudioAttachment $audio_attachment): AudioAttachmentResource
    {
        return new AudioAttachmentResource($audio_attachment);
    }

    public function update(UpdateAudioAttachmentRequest $request, AudioAttachment $audio_attachment): AudioAttachmentResource
    {
        $audio_attachment->update($request->validated());

        return new AudioAttachmentResource($audio_attachment);
    }

    public function destroy(AudioAttachment $audio_attachment)
    {
        $audio_attachment->delete();

        return response()->json(null, 204);
    }
}
