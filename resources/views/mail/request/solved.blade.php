<x-mail::message>
# Request answered &checkmark;

Hi there, your request **"{{ $title }}"** was answered. Please login to review it.

<x-mail::button :url="route('login')">
Login to Spanish for Fun
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
