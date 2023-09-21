<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ecommerce</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: fantasy;
        }

        .container {
            display: flex;
            justify-content: center;
        }

        .nav-bar {
            display: flex;
            flex: 1;
            padding: 15px;
            border: 1px solid;
            border-color: blue;
            justify-content: space-around;
        }

        .itens-nav {
            list-style: none;
        }

        .item-nav {
            margin: 0px 10px;
            text-decoration: none;
            font-size: 18px;
        }

        .group-auth {
            justify-content: space-between;
        }
    </style>
</head>

<body class="container">
    <div class="nav-bar">
        <ul class="itens-nav">
            <li class="item-nav">Romas Dev. FullStack</li>
        </ul>
        @if (Route::has('login'))
        <div class="group-auth">
            @auth
            <a href="{{ url('/home') }}" class="item-nav">Home</a>
            @else
            <a href="{{ route('login') }}" class="item-nav">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 item-nav">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div>
</body>

</html>