@props(['value'])

<title>{{ config('app.name') }} | {{ $value ?? $slot }}</title>
