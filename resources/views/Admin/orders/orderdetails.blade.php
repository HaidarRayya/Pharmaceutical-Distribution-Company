<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home page</title>
    <!-- Render All Elements Normally -->
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('Css/normalize.css') }}" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="{{ url('Css/all.min.css') }}" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="{{ url('Css/order-details.css') }}" />
</head>

<body>
    <!-- Start Header -->
    <header>
        <div class="container">
            <a href="#" class="logo">
                <img decoding="async" src={{ asset('images/logo.png') }} alt="Logo" />
            </a>
            <nav>
                <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
                <ul id="link">
                    <li><a href="/customer">Home</a></li>
                    <li><a class="active" href="{{ route('admin.orders.index', ['admin' => Auth::user()]) }}">Orders</a>
                    </li>

                    <li class="logout">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="logout-button" type="submit"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i></button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <body>

        <div class="content">
            @foreach ($medicines as $medicine)
            <div class="card">
                <img src="{{ asset('storage' . '/' . $medicine['image']) }}" />
                <div>
                    <h2 class="text">{{ $medicine['name'] }}</h2>
                    <p class="text"> they have ordered {{ $medicine['quantity'] }} pieces </p>
                    <p class="text"> price for one piece:{{ $medicine['price'] }} pieces </p>
                    <p class="text"> price for all pieces:{{ $medicine['price'] * $medicine['quantity'] }} pieces
                    </p>
                </div>

            </div>
            @endforeach
        </div>
        <div class="buttons">
            <a class="btn" href="/admin/{{ Auth::user()->id }}/orders/{{ $order['id'] }}/chooseDriver">choose
                driver and accept</a>
            <form action="/admin/reject/{{ $order['id'] }}" method="post">
                @csrf
                <input type="submit" class="btn" value="reject">
            </form>
        </div>
        <script src="{{ url('main.js') }}"></script>
    </body>