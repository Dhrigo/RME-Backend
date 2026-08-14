<?php

namespace Modules\BpjsPCare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsPCare\Concerns\CallsBpjsPCare;
use Modules\BpjsPCare\Http\Requests\StoreSkrinningRequest;
use Modules\BpjsPCare\Http\Requests\UpdateSkrinningRequest;
use Modules\BpjsPCare\Http\Resources\SkrinningResource;
use Modules\BpjsPCare\Models\Skrinning;

class SkrinningController extends Controller
{
    use CallsBpjsPCare;

    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return SkrinningResource::collection(Skrinning::all());
    }

    public function store(StoreSkrinningRequest $request): SkrinningResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'POST', 'skrinning', $data);

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : null;
        $data['bpjs_error'] = $result['error'];

        $skrinning = Skrinning::create($data);

        return new SkrinningResource($skrinning);
    }

    public function show(Skrinning $skrinning): SkrinningResource
    {
        return new SkrinningResource($skrinning);
    }

    public function update(UpdateSkrinningRequest $request, Skrinning $skrinning): SkrinningResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'PUT', 'skrinning', array_merge(['id' => $skrinning->id], $data));

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : $skrinning->bpjs_response;
        $data['bpjs_error'] = $result['error'];

        $skrinning->update($data);

        return new SkrinningResource($skrinning);
    }

    public function destroy(Skrinning $skrinning): Response|JsonResponse
    {
        $result = $this->pcareCall($this->client, 'DELETE', 'skrinning/'.$skrinning->id);

        if (! $result['success']) {
            $skrinning->update(['bpjs_error' => $result['error']]);

            return response()->json(['message' => $result['error']], 422);
        }

        $skrinning->delete();

        return response()->noContent();
    }
}
