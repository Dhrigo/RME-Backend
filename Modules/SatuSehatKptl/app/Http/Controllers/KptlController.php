<?php

namespace Modules\SatuSehatKptl\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SatuSehatKptl\Services\KptlClient;

class KptlController extends Controller
{
    public function __construct(private readonly KptlClient $client)
    {
    }

    public function code(Request $request)
    {
        $request->validate(['query_string' => ['required', 'string']]);

        return response()->json($this->client->code(
            $request->string('query_string'),
            (int) $request->input('offset', 0),
            (int) $request->input('limit', 5),
        ));
    }

    public function baseCode(Request $request)
    {
        $request->validate(['query_string' => ['required', 'string']]);

        return response()->json($this->client->baseCode(
            $request->string('query_string'),
            (int) $request->input('offset', 0),
            (int) $request->input('limit', 5),
        ));
    }

    public function baseCodeCombination(Request $request)
    {
        $request->validate(['query_string' => ['required', 'string']]);

        return response()->json($this->client->baseCodeCombination(
            $request->string('query_string'),
            (int) $request->input('max_iteration', 2),
        ));
    }

    public function modifier(Request $request)
    {
        return response()->json($this->client->modifier(
            (string) $request->input('query_string', ''),
            (int) $request->input('offset', 0),
            (int) $request->input('limit', 50),
        ));
    }

    public function modifierValue(Request $request)
    {
        $request->validate(['query_string' => ['required', 'string']]);

        return response()->json($this->client->modifierValue($request->string('query_string')));
    }

    public function baseCodeByModifier(Request $request)
    {
        $request->validate(['query_string' => ['required', 'string']]);

        return response()->json($this->client->baseCodeByModifier(
            $request->string('query_string'),
            (int) $request->input('offset', 0),
            (int) $request->input('limit', 10),
        ));
    }
}
