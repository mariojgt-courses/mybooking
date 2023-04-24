<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Carbon;

class BookingTextTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testTextBooking(): void
    {
        $this->browse(function (Browser $browser) {
            /*
            |--------------------------------------------------------------------------
            | 01 Visit the website and click in the booking button
            |--------------------------------------------------------------------------
            */
            $browser->visit('/');
            $browser->waitFor('@booking');
            $browser->click('@booking');

            /*
            |--------------------------------------------------------------------------
            | 02 Visit the website and click in the booking button
            |--------------------------------------------------------------------------
            */
            $browser->waitFor('@name');
            $customer = 'John Doe';
            $browser->type('@name', $customer);
            $browser->type('@email', 'john@test.com');
            $browser->type('@phone', '123456789');
            $browser->type('@plate', '1234ABC');
            // Get this month date that is not a weekend
            $date = Carbon::now()->startOfMonth()->addWeekdays(5);
            $browser->type('@date', $date->format('d/m/Y'));
            // Now select the first @time option
            $browser->waitFor('@time');
            $browser->click('@time');
            $browser->waitFor('@submit');
            $browser->click('@submit');

            /*
            |--------------------------------------------------------------------------
            | 03 Confirm the booking
            |--------------------------------------------------------------------------
            */
            $browser->waitForText('Booking created successfully');
            $browser->assertSee('Booking created successfully');
            $browser->visit('/manage');
            $browser->waitForText('Bookings');
            $browser->assertSee($customer);

            /*
            |--------------------------------------------------------------------------
            | 04 Delete the booking
            |--------------------------------------------------------------------------
            */
            $browser->waitFor("[dusk='John Doe']");
            $browser->click("[dusk='John Doe']");
            $browser->waitFor("@modal-submit");
            $browser->click("@modal-submit");
            $browser->waitForText('Booking deleted successfully');
            $browser->assertSee('Booking deleted successfully');
        });
    }
}
