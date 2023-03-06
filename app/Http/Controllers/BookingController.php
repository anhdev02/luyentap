<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() {
        return view('ticket');
    }

    public function searchticket() {
        return view('searchticket');
    }

    public function store(Request $request) {
        $booking = new Booking;
        $booking->route_name = $request->input('route_name');
        $booking->start_station = $request->input('start_station');
        $booking->end_station = $request->input('end_station');
        $booking->quantity = $request->input('quantity');
        $booking->phone = $request->input('phone');
        $booking->total = $request->input('total');
        $booking->save();
        return response()->json([
            'message' => 'Đặt vé thành công !',
        ]);
    }

    public function getTicket($phone) {
        $tickets = Booking::where('phone', $phone)->get();
        return response()->json([
            'tickets' => $tickets,
        ]);
    }
}
