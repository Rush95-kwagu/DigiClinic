<x-mail::message>
# {{ $mailData['name'] }}
# {{ $mailData['email'] }}
# {{ $mailData['subject'] }}

 {{ $mailData['msg'] }}

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
