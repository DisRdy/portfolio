<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Komentar' }}</title>
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>
<body>
    <div class="layout-wrapper">
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>
