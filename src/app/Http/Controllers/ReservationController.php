<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Shop;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
        {
            $reservations = Reservation::query();
            if ($request->filled('keyword')) {
                $reservations->where(
                    'customer_name',
                    'like',
                    '%' . $request->keyword . '%'
                );
            }
            $reservations = $reservations->get();
            $pendingCount = Reservation::where('status', 'pending')->count();
            $confirmedCount = Reservation::where('status', 'confirmed')->count();
            $completedCount = Reservation::where('status', 'completed')->count();
            $cancelledCount = Reservation::where('status', 'cancelled')->count();
            $todayCount = Reservation::whereDate('reserved_at',now()->toDateString())->count();
            $totalCount = Reservation::count();
            return view(
                'reservations.index',
                compact('reservations', 'pendingCount', 'confirmedCount', 'completedCount', 'cancelledCount', 'todayCount','totalCount')
            );

        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
            $shops = Shop::all();

            return view(
                'reservations.create',
                compact('shops')
            );
            //
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Reservation::create([
            'user_id' => auth()->id(),
            'shop_id' => $request->shop_id,
            'customer_name' => $request->customer_name,
            'reserved_at' => $request->reserved_at,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('reservations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $shops = Shop::all();

        return view(
            'reservations.edit',
            compact(
                'reservation',
                'shops'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'shop_id' => $request->shop_id,
            'customer_name' => $request->customer_name,
            'reserved_at' => $request->reserved_at,
        ]);

        return redirect()
            ->route('reservations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()
            ->route('reservations.index');
    }
    public function confirm(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'confirmed',
        ]);

        return redirect()
            ->route('reservations.index');
    }
    public function complete(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'completed',
        ]);

        return redirect()
            ->route('reservations.index');
    }
    public function cancel(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('reservations.index');
    }
}
