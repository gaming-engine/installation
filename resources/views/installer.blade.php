<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gaming Engine</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/framework/gaming-engine.css') }}" rel="stylesheet">
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased text-gray-900">
<div class="pt-4">
    <img
        class="w-auto d-block m-auto"
        style="height: 100px"
        src="/images/framework/logo.svg"
        title="Gaming Engine"
        alt="Gaming Engine"
    />
</div>

<div class="px-4 sm:px-6 lg:px-8 bg-white" id="app">
    <div class="max-w-max-content lg:max-w-7xl mx-auto">
        <x-ge:l-wizard/>
    </div>
</div>

</body>
</html>
