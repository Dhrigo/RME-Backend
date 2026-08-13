<?php

namespace Modules\PegawaiPracticeLicense\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PegawaiPracticeLicense\Http\Requests\StorePracticeLicenseRequest;
use Modules\PegawaiPracticeLicense\Http\Requests\UpdatePracticeLicenseRequest;
use Modules\PegawaiPracticeLicense\Http\Resources\PracticeLicenseResource;
use Modules\PegawaiPracticeLicense\Models\PracticeLicense;

class PracticeLicenseController extends Controller
{
    public function index(Request $request)
    {
        $query = PracticeLicense::query();

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->integer('employee_id'));
        }

        return PracticeLicenseResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePracticeLicenseRequest $request)
    {
        $license = PracticeLicense::create($request->validated());

        return (new PracticeLicenseResource($license))->response()->setStatusCode(201);
    }

    public function show(PracticeLicense $practiceLicense): PracticeLicenseResource
    {
        return new PracticeLicenseResource($practiceLicense);
    }

    public function update(UpdatePracticeLicenseRequest $request, PracticeLicense $practiceLicense): PracticeLicenseResource
    {
        $practiceLicense->update($request->validated());

        return new PracticeLicenseResource($practiceLicense);
    }
}
