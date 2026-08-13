<?php

namespace Modules\GeneralBirthplace\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralBirthplace\Http\Requests\StoreBirthplaceRequest;
use Modules\GeneralBirthplace\Http\Requests\UpdateBirthplaceRequest;
use Modules\GeneralBirthplace\Http\Resources\BirthplaceResource;
use Modules\GeneralBirthplace\Models\Birthplace;

class BirthplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Birthplace::query();

        return BirthplaceResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBirthplaceRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $birthplace = Birthplace::create($data);

        return (new BirthplaceResource($birthplace))->response()->setStatusCode(201);
    }

    public function show(Birthplace $birthplace): BirthplaceResource
    {
        return new BirthplaceResource($birthplace);
    }

    public function update(UpdateBirthplaceRequest $request, Birthplace $birthplace): BirthplaceResource
    {
        $birthplace->update($request->validated());

        return new BirthplaceResource($birthplace);
    }

    public function destroy(Birthplace $birthplace)
    {
        $birthplace->delete();

        return response()->json(null, 204);
    }
}
