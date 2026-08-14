<?php

namespace Modules\BpjsPCare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsPCare\Concerns\CallsBpjsPCare;
use Modules\BpjsPCare\Http\Requests\StoreAlergiRequest;
use Modules\BpjsPCare\Http\Requests\UpdateAlergiRequest;
use Modules\BpjsPCare\Http\Resources\AlergiResource;
use Modules\BpjsPCare\Models\Alergi;

class AlergiController extends Controller
{
    use CallsBpjsPCare;

    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return AlergiResource::collection(Alergi::all());
    }

    public function store(StoreAlergiRequest $request): AlergiResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'POST', 'alergi', $data);

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : null;
        $data['bpjs_error'] = $result['error'];

        $alergi = Alergi::create($data);

        return new AlergiResource($alergi);
    }

    public function show(Alergi $alergi): AlergiResource
    {
        return new AlergiResource($alergi);
    }

    public function update(UpdateAlergiRequest $request, Alergi $alergi): AlergiResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'PUT', 'alergi', array_merge(['id' => $alergi->id], $data));

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : $alergi->bpjs_response;
        $data['bpjs_error'] = $result['error'];

        $alergi->update($data);

        return new AlergiResource($alergi);
    }

    public function destroy(Alergi $alergi): Response|JsonResponse
    {
        $result = $this->pcareCall($this->client, 'DELETE', 'alergi/'.$alergi->id);

        if (! $result['success']) {
            $alergi->update(['bpjs_error' => $result['error']]);

            return response()->json(['message' => $result['error']], 422);
        }

        $alergi->delete();

        return response()->noContent();
    }
}
