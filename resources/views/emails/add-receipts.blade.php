@component('mail::message')
# Hi {{$customer['name']}},

Thank you for shopping with Manama Gold. Your total amount is BD {{$totalAmount}} with {{$entiesCount}} chance(s) to enter the weekly draw.


Thanks,<br>
{{ config('app.name') }}
@endcomponent