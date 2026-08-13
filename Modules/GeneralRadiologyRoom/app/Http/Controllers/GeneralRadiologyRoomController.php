<?php

namespace Modules\GeneralRadiologyRoom\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralRadiologyRoom\Models\RadiologyRoom;

class GeneralRadiologyRoomController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyRoom::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return $query->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'radiology_type' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(RadiologyRoom::create($data)->refresh(), 201);
    }

    public function show(RadiologyRoom $radiologyRoom): RadiologyRoom
    {
        return $radiologyRoom;
    }

    public function update(Request $request, RadiologyRoom $radiologyRoom): RadiologyRoom
    {
        $data = $request->validate([
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'radiology_type' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $radiologyRoom->update($data);

        return $radiologyRoom;
    }

    public function destroy(RadiologyRoom $radiologyRoom)
    {
        $radiologyRoom->delete();

        return response()->json(null, 204);
    }
}
