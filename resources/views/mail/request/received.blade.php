<x-mail::message>
# New incomming request

You've got a new service request at {{config('app.name')}}.
<x-mail::button :url="route('login')">
Log in
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
