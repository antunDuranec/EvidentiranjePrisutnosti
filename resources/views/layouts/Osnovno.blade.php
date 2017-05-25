<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/icon?family=Material+Icons' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/sidenav.min.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/small.css')?>" type="text/css">

    <title>Studenti - evidencija</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo asset('picture/logo-org.ico')?>"/>
    <style type="text/css">
        body {
            background: #eee;
            font-family: 'Roboto', sans-serif;
        }
        .toggle {
            color: #000000;
            display: block;
            height: 72px;
            line-height: 72px;
            text-align: center;
            width: 72px;
        }
        h1 { margin:30px auto; text-align:center;}
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>

<body>

@include('layouts.Navigacijskibar')

@if(Auth::guest())

@else
    @if(Auth::user()->razina_prava==1)
        @include('layouts.NavigacijaAdmin')
    @endif
@endif

@yield('content')
<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{ asset('js/sidenav.min.js') }}"></script>
<script>$('[data-sidenav]').sidenav();</script>
</body>

</html>
