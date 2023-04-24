<x-mail::message>

{{ $booking->name }} has confirmed their booking for {{ $booking->email }} on {{ $booking->date->format('l jS F Y') }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
