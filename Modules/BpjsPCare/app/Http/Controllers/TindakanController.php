<?php

namespace Modules\BpjsPCare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsPCare\Concerns\CallsBpjsPCare;
use Modules\BpjsPCare\Http\Requests\StoreTindakanRequest;
use Modules\BpjsPCare\Http\Requests\UpdateTindakanRequest;
use Modules\BpjsPCare\Http\Resources\TindakanResource;
use Modules\BpjsPCare\Models\Tindakan;

class TindakanController extends Controller
{
    use CallsBpjsPCare;

    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return TindakanResource::collection(Tindakan::all());
    }

    public function store(StoreTindakanRequest $request): TindakanResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'POST', 'tindakan', $data);

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : null;
        $data['bpjs_error'] = $result['error'];

        $tindakan = Tindakan::create($data);

        return new TindakanResource($tindakan);
    }

    public function show(Tindakan $tindakan): TindakanResource
    {
        return new TindakanResource($tindakan);
    }

    public function update(UpdateTindakanRequest $request, Tindakan $tindakan): TindakanResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'PUT', 'tindakan', array_merge(['id' => $tindakan->id], $data));

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : $tindakan->bpjs_response;
        $data['bpjs_error'] = $result['error'];

        $tindakan->update($data);

        return new TindakanResource($tindakan);
    }

    public function destroy(Tindakan $tindakan): Response|JsonResponse
    {
        $result = $this->pcareCall($this->client, 'DELETE', 'tindakan/'.$tindakan->id);

        if (! $result['success']) {
            $tindakan->update(['bpjs_error' => $result['error']]);

            return response()->json(['message' => $result['error']], 422);
        }

        $tindakan->delete();

        return response()->noContent();
    }
}
