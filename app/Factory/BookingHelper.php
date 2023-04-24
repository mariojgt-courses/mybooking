<?php

namespace App\Factory;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\BookingBlockedSlot;

class BookingHelper
{
    public function returnDateBookings(Carbon $date, $calendarMode = false)
    {
        // Create two Carbon objects for the open and close times
        $openTime = Carbon::parse('09:00:00');
        $closeTime = Carbon::parse('17:30:00');

        // Now create a array of times between the open and close times
        $times = [];
        while ($openTime->lte($closeTime)) {
            $times[] = $openTime->format('H:i');
            $openTime->addMinutes(30);
        }

        // Now we need to get all the bookings for the current day
        $bookings = Booking::whereDate('date', $date)->get();

        $blockedDay = BookingBlockedSlot::whereDate('date', $date)->first();

        if (!empty($blockedDay)) {
            $times = [
                'blocked'    => true,
                'blockedDay' => $blockedDay,
            ];
        } else {
            // check if the date is a weekend
            if ($date->isWeekend()) {
                $times = [
                    'blocked'    => true,
                    'is_weekend' => true,
                ];
            } else {
                // Now we need to loop through the times and check if there is a booking for that time
                foreach ($times as $key => $time) {
                    foreach ($bookings as $booking) {
                        if ($calendarMode) {
                            if ($booking->date->format('H:i') == $time) {
                                $times['bookings'][] = [
                                    'time' => $time,
                                    'booking' => $booking,
                                ];
                            }
                        } else {
                            if ($booking->date->format('H:i') == $time) {
                                unset($times[$key]);
                            }
                        }
                    }
                }
            }
        }

        return $times;
    }

    public function buildCalendar(Carbon $date)
    {
        // Now get the first day of the month and the last day of the month
        $firstDayOfMonth = Carbon::parse($date->format('Y-m-01'));
        $lastDayOfMonth = Carbon::parse($date->format('Y-m-t'));

        // Get the beginning of the week for the first day of the month
        $firstDayOfMonth->startOfWeek();
        // Get the end of the week for the last day of the month
        $lastDayOfMonth->endOfWeek();

        // Now create a range of dates between the first and last day of the month
        $dates = [];
        while ($firstDayOfMonth->lte($lastDayOfMonth)) {
            $dates[] = $firstDayOfMonth->format('Y-m-d');
            $firstDayOfMonth->addDay();
        }

        // Now loop through the dates and get the bookings for each date
        $calendar = [];
        foreach ($dates as $date) {
            $calendar[$date] = $this->returnDateBookings(Carbon::parse($date), true);
        }

        $calendar = array_chunk($calendar, 7, true);

        return $calendar;
    }
}
