<?php

namespace Modules\BpjsPCare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsPCare\Concerns\CallsBpjsPCare;
use Modules\BpjsPCare\Http\Requests\StoreMcuRequest;
use Modules\BpjsPCare\Http\Requests\UpdateMcuRequest;
use Modules\BpjsPCare\Http\Resources\McuResource;
use Modules\BpjsPCare\Models\Mcu;

class McuController extends Controller
{
    use CallsBpjsPCare;

    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return McuResource::collection(Mcu::all());
    }

    public function store(StoreMcuRequest $request): McuResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'POST', 'mcu', $data);

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : null;
        $data['bpjs_error'] = $result['error'];

        $mcu = Mcu::create($data);

        return new McuResource($mcu);
    }

    public function show(Mcu $mcu): McuResource
    {
        return new McuResource($mcu);
    }

    public function update(UpdateMcuRequest $request, Mcu $mcu): McuResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'PUT', 'mcu', array_merge(['id' => $mcu->id], $data));

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : $mcu->bpjs_response;
        $data['bpjs_error'] = $result['error'];

        $mcu->update($data);

        return new McuResource($mcu);
    }

    public function destroy(Mcu $mcu): Response|JsonResponse
    {
        $result = $this->pcareCall($this->client, 'DELETE', 'mcu/'.$mcu->id);

        if (! $result['success']) {
            $mcu->update(['bpjs_error' => $result['error']]);

            return response()->json(['message' => $result['error']], 422);
        }

        $mcu->delete();

        return response()->noContent();
    }
}
