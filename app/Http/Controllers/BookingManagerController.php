<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Slot;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Factory\BookingHelper;
use App\Models\BookingBlockedSlot;
use Illuminate\Support\Facades\Redirect;

class BookingManagerController extends Controller
{
    public function index(Request $request)
    {
        $booking = new BookingHelper();
        if ($request->nextMonth) {
            $date = Carbon::parse($request->current_date);
            if ($request->nextMonth === 'true') {
                $date->addMonth();
            } else {
                $date->subMonth();
            }

        } else {
            $date = !empty($request->date) ? Carbon::parse($request->date) : Carbon::now();
        }
        $bookings = $booking->returnDateBookings($date);
        $calendar = $booking->buildCalendar($date);

        return Inertia::render('Manage/Index', [
            'title'                    => 'Manage Booking',
            'bookings'                 => $bookings,
            'calendar'                 => $calendar,
            'selected_data'            => $date,
            'selected_data_month_year' => $date->format('F Y'),
        ]);
    }
}
