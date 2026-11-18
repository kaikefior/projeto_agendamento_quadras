<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Court;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class ReservationController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $filters = $request->validate([
            'court_id' => [
                'nullable',
                'integer',
                Rule::exists('courts', 'id')->where('status', 'available'),
            ],
            'reservation_date' => [
                'nullable',
                'date_format:Y-m-d',
                'after_or_equal:today',
            ],
        ]);

        $courts = Court::query()
            ->where('status', 'available')
            ->orderBy('name')
            ->get();

        $selectedCourt = isset($filters['court_id'])
            ? courts->firstWhere('id', (int) $filters['court_id'])
            : null;

        $date = $filters['reservation_date'] ?? now()->toDateString();
        $slots = [];

        if ($selectedCourt) {
            $booked = Reservation::query()
                ->where('court_id', $selectedCourt->id)
                ->where('reservation_date', $date)
                ->where('status', 'confirmed')
                ->get(['start_time', 'end_time']);
            
                 foreach (range(8, 21) as $hour) {
            $start = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $date.' '.sprintf('%02d:00:00', $hour),
                config('app.timezone')
            );
            $end = $start->copy()->addHour();

            $occupied = $booked->contains(
                fn (Reservation $reservation): bool =>
                    Carbon::parse($reservation->start_time, config('app.timezone'))->lt($end)
                    && Carbon::parse($reservation->end_time, config('app.timezone'))->gt($start)
            );

            $slots[] = [
                'start' => $start->format('H:i'),
                'end' => $end->format('H:i'),
                'available' => $start->isFuture() && ! $occupied,
            ];
        }
    }

    return view('reservations.create', compact(
        'courts',
        'selectedCourt',
        'date',
        'slots'
    ));
}

    public function store(Request $request)
    {
        $hours = array_map(
            fn (int $hour): string => sprintf('%02d:00', $hour),
            range(8, 21)
        );

        $data = $request->validate([
            'court_id' => ['required', 'integer', 'exists:courts,id'],
            'reservation_date' => ['required', 'date_format:Y-m-d'],
            'start_time' => ['required', 'date_format:H:i', Rule::in($hours)],
        ]);

        $start = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $data['reservation_date'].' '.$data['start_time'].':00',
            config('app.timezone')
        );
        $end = $start->copy()->addHour();

        if ($start->lessThanOrEqualTo(now())) {
            throw ValidationException::withMessages([
                'start_time' => 'Escolha um horário futuro.',
            ]);
        }

        try {
            DB::transaction(function () use ($request, $data, $start, $end) {
                $court = Court::findOrFail($data['court_id']);

                if ($court->status !== 'available') {
                    throw ValidationException::withMessages([
                        'court_id' => 'Esta quadra está indisponível.',
                    ]);
                }

                $conflict = Reservation::query()
                    ->where('court_id', $court->id)
                    ->where('status', 'confirmed')
                    ->where('start_time', '<', $end->toDateTimeString())
                    ->where('end_time', '>', $start->toDateTimeString())
                    ->exists();

                if ($conflict) {
                    throw ValidationException::withMessages([
                        'start_time' => 'Este horário já está reservado.',
                    ]);
                }

                $reservation = new Reservation();
                $reservation->user_id = $request->user()->id;
                $reservation->court_id = $court->id;
                $reservation->reservation_date = $data['reservation_date'];
                $reservation->start_time = $start->toDateTimeString();
                $reservation->end_time = $end->toDateTimeString();
                $reservation->status = 'confirmed';
                $reservation->save();
            });
        } catch (UniqueConstraintViolationException $exception) {
            throw ValidationException::withMessages([
                'start_time' => 'Este horário já está reservado. Escolha outro',
            ]);
        }

        return redirect()
            ->route('courts.index')
            ->with('success', 'Reserva realizada com sucesso.');
    }

    public function show(Reservation $reservation)
    {
        //
    }

    public function edit(Reservation $reservation)
    {
        //
    }

    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    public function destroy(Reservation $reservation)
    {
        //
    }
}
