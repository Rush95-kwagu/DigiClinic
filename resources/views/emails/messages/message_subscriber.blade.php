<x-mail::message>
# {{ $mailData['subject'] }} <br>
  {!! $mailData['message'] !!}<br>
Bien à vous,<br>
<x-mail::button :url="\URL::to('/unsubscribe/'.$mailData['subscriber_mail'])">
Se désabonner
</x-mail::button>

Cordialement,<br>
{{ config('app.name') }}
</x-mail::message>
