<?php

namespace Modules\BpjsPCare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsPCare\Concerns\CallsBpjsPCare;
use Modules\BpjsPCare\Http\Requests\StorePrognosaRequest;
use Modules\BpjsPCare\Http\Requests\UpdatePrognosaRequest;
use Modules\BpjsPCare\Http\Resources\PrognosaResource;
use Modules\BpjsPCare\Models\Prognosa;

class PrognosaController extends Controller
{
    use CallsBpjsPCare;

    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return PrognosaResource::collection(Prognosa::all());
    }

    public function store(StorePrognosaRequest $request): PrognosaResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'POST', 'prognosa', $data);

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : null;
        $data['bpjs_error'] = $result['error'];

        $prognosa = Prognosa::create($data);

        return new PrognosaResource($prognosa);
    }

    public function show(Prognosa $prognosa): PrognosaResource
    {
        return new PrognosaResource($prognosa);
    }

    public function update(UpdatePrognosaRequest $request, Prognosa $prognosa): PrognosaResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'PUT', 'prognosa', array_merge(['id' => $prognosa->id], $data));

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : $prognosa->bpjs_response;
        $data['bpjs_error'] = $result['error'];

        $prognosa->update($data);

        return new PrognosaResource($prognosa);
    }

    public function destroy(Prognosa $prognosa): Response|JsonResponse
    {
        $result = $this->pcareCall($this->client, 'DELETE', 'prognosa/'.$prognosa->id);

        if (! $result['success']) {
            $prognosa->update(['bpjs_error' => $result['error']]);

            return response()->json(['message' => $result['error']], 422);
        }

        $prognosa->delete();

        return response()->noContent();
    }
}
