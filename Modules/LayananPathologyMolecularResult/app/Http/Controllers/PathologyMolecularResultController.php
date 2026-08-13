<?php

namespace Modules\LayananPathologyMolecularResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPathologyMolecularResult\Http\Requests\StorePathologyMolecularResultRequest;
use Modules\LayananPathologyMolecularResult\Http\Resources\PathologyMolecularResultResource;
use Modules\LayananPathologyMolecularResult\Models\PathologyMolecularResult;

class PathologyMolecularResultController extends Controller
{
    public function index(Request $request)
    {
        $query = PathologyMolecularResult::query();

        return PathologyMolecularResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePathologyMolecularResultRequest $request)
    {
        $data = $request->validated();

        $pa_mol_result = PathologyMolecularResult::create($data);

        return (new PathologyMolecularResultResource($pa_mol_result))->response()->setStatusCode(201);
    }

    public function show(PathologyMolecularResult $pa_mol_result): PathologyMolecularResultResource
    {
        return new PathologyMolecularResultResource($pa_mol_result);
    }
}
