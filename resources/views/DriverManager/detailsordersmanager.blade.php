<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home page</title>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="{{ url('Css/normalize.css') }}" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="{{ url('Css/all.min.css') }}" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="{{ url('Css/details-orders-manager.css') }}" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />

</head>

<body>
    <header>
        <div class="container">
            <a href="#" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt>
            </a>
            <nav>
                <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
                <ul id="link">
                    <li><a href="/driverManager">Home</a></li>
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
    @if (session()->has('message'))
    <div class="Message" id="Message">
        <div class="Message-icon">
            <i class="fa fa-bell-o"></i>
        </div>
        <div class="Message-body">
            <p> {{ session('message') }} </p>
            <button value="Message" value="Message" onclick="Message()" class="Message-button js-messageClose">close
            </button>
        </div>
    </div>
    @endif
    <div class="container">
        <div class="card">
            <div class="content">
                @foreach ($orderMedicines as $orderMedicine)
                <p> {{ $orderMedicine['quantity'] }} pieces of {{ $orderMedicine['name'] }} </p>
                <hr>
                @endforeach
            </div>
            <div class="btn">
                <form action="/driverManager/{{ $order_id }}/accept" method="post">
                    @csrf
                    <input class="btn" type="submit" value="Done">
                </form>
            </div>
        </div>

    </div>
    <script src="{{ url('main.js') }}"></script>

</body>

</html>