<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Slot;
use Inertia\Inertia;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Factory\BookingHelper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Mail\Booking as BookingMail;

class BookingCustomerController extends Controller
{
    public function index(Request $request)
    {
        $booking = new BookingHelper();
        $bookings = $booking->returnDateBookings(!empty($request->date) ? Carbon::parse($request->date) : Carbon::now());
        return Inertia::render('CustomerBooking/Index', [
            'title'         => 'Customer Booking',
            'bookings'      => $bookings,
            'selected_data' => !empty($request->date) ? Carbon::parse($request->date)->format('Y-m-d') : Carbon::now()->format('Y-m-d'),
        ]);
    }
}
