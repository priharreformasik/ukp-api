@component('mail::message')
# Kode Verifikasi

Mohon melakukan verifikasi email dengan kode verifikasi berikut ini:

@component('mail::button', ['url' => '#'])
{{$otp}}
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
