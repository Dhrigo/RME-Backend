<?php

namespace Modules\SatuSehatMasterData\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SatuSehatMasterData\Services\MasterDataClient;

/**
 * Thin passthrough of the SATUSEHAT Master Data API lookups - see
 * MasterDataClient for the exact endpoint/query-param mapping ported from
 * kemkes_research_findings_part2.md section 2.2.
 */
class MasterDataController extends Controller
{
    public function __construct(private readonly MasterDataClient $client)
    {
    }

    public function provinces()
    {
        return response()->json($this->client->provinces());
    }

    public function cities(Request $request)
    {
        return response()->json($this->client->cities($request->query()));
    }

    public function districts(Request $request)
    {
        return response()->json($this->client->districts($request->query()));
    }

    public function subDistricts(Request $request)
    {
        return response()->json($this->client->subDistricts($request->query()));
    }

    public function sarana(Request $request)
    {
        return response()->json($this->client->sarana($request->query()));
    }

    public function kfaProduct(Request $request)
    {
        $request->validate([
            'identifier' => ['required', 'in:kfa,lkpp,nie'],
            'code' => ['required', 'string'],
        ]);

        return response()->json($this->client->kfaProductV2(
            $request->string('identifier'),
            $request->string('code'),
            $request->string('template_code')->value() ?: null,
        ));
    }

    public function kfaProductsAll(Request $request)
    {
        $request->validate([
            'page' => ['required'],
            'size' => ['required'],
            'product_type' => ['required', 'in:alkes,farmasi'],
        ]);

        return response()->json($this->client->kfaProductsAllV2($request->query()));
    }
}
