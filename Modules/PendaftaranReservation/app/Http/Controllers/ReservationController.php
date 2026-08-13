<?php

namespace Modules\PendaftaranReservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranReservation\Http\Requests\StoreReservationRequest;
use Modules\PendaftaranReservation\Http\Requests\UpdateReservationRequest;
use Modules\PendaftaranReservation\Http\Resources\ReservationResource;
use Modules\PendaftaranReservation\Models\Reservation;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return ReservationResource::collection($query->latest('reserved_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreReservationRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'pending';

        $reservation = Reservation::create($data);

        return (new ReservationResource($reservation))->response()->setStatusCode(201);
    }

    public function show(Reservation $reservation): ReservationResource
    {
        return new ReservationResource($reservation);
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation): ReservationResource
    {
        $reservation->update($request->validated());

        return new ReservationResource($reservation);
    }
}
