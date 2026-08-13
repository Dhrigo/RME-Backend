<?php

namespace Modules\MedicalRecordImageMarker\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordImageMarker\Http\Requests\StoreImageMarkerRequest;
use Modules\MedicalRecordImageMarker\Http\Requests\UpdateImageMarkerRequest;
use Modules\MedicalRecordImageMarker\Http\Resources\ImageMarkerResource;
use Modules\MedicalRecordImageMarker\Models\ImageMarker;

class ImageMarkerController extends Controller
{
    public function index(Request $request)
    {
        $query = ImageMarker::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ImageMarkerResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreImageMarkerRequest $request)
    {
        $data = $request->validated();

        $data['marked_at'] ??= now();

        $record = ImageMarker::create($data);

        return (new ImageMarkerResource($record))->response()->setStatusCode(201);
    }

    public function show(ImageMarker $record): ImageMarkerResource
    {
        return new ImageMarkerResource($record);
    }

    public function update(UpdateImageMarkerRequest $request, ImageMarker $record): ImageMarkerResource
    {
        $record->update($request->validated());

        return new ImageMarkerResource($record);
    }

    public function destroy(ImageMarker $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
