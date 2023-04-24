<?php

namespace App\Http\Controllers;

use App\Factory\BookingHelper;
use App\Mail\Booking as BookingMail;
use App\Mail\BookingDeleted;
use App\Models\Booking;
use App\Models\BookingBlockedSlot;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Is the user manager trying to block a day?
        if ($request->blockDay) {
            // Validated the date and check if is not a blocked day already
            $data =  $this->validate($request, [
                'date'  => 'required|date_format:Y-m-d',
            ]);

            $bookingBlockedSlot = new BookingBlockedSlot();
            $bookingBlockedSlot->date = Carbon::parse($data['date']);
            $bookingBlockedSlot->save();

            return Redirect::back()->with('success', 'Day blocked successfully');
        }

        $data =  $this->validate($request, [
            'name'  => 'required',
            'email' => 'required',
            'phone' => 'required',
            'plate' => 'required',
            'time'  => 'required|date_format:H:i',
            'date'  => 'required|date_format:Y-m-d',
        ]);

        $booking = new Booking();
        $booking->name = $data['name'];
        $booking->email = $data['email'];
        $booking->phone = $data['phone'];
        $booking->model = $data['plate'];
        // Save the date and create a carbon object using the date and time
        $booking->date = Carbon::parse($data['date'] . ' ' . $data['time']);
        $booking->save();

        // Send the booking mail and cc the admin
        Mail::to($data['email'])->cc(config('mail.from.address'))->send(new BookingMail($booking));

        // Send back with success message
        return Redirect::back()->with('success', 'Booking created successfully');
    }

    /**
     * Remove the booking
     *
     * @param Booking $booking
     *
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        Mail::to($booking->email)->cc(config('mail.from.address'))->send(new BookingDeleted($booking));

        return Redirect::back()->with('success', 'Booking deleted successfully');
    }

    /**
     * Remove the booking blocked day
     *
     * @param BookingBlockedSlot $bookingBlockedSlot
     *
     */
    public function destroyDay(BookingBlockedSlot $bookingBlockedSlot)
    {
        $bookingBlockedSlot->delete();

        return Redirect::back()->with('success', 'Day unblocked successfully');
    }
}
