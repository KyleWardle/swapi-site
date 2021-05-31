<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Star Wars Information DB</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')

</head>
<body>
    @include('layouts.navbar')
        <main class="container-fluid ">
            @yield('content')
        </main>
    </body>
</html>
