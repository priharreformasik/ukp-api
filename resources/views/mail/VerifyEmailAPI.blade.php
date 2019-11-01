@component('mail::message')
# Introduction

mohon melakukan verifikasi email kamu dengan memasukkan kode berikut ini:

@component('mail::button', ['url' => '#'])
{{$otp}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
