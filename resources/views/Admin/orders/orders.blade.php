<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>your cart</title>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="{{ url('Css/normalize.css') }}" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="{{ url('Css/all.min.css') }}" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="{{ url('Css/orders-admin.css') }}" />
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />
    <script src="https://kit.fontawesome.com/91eada0414.js" crossorigin="anonymous"></script>
    <!-- Google Fonts -->
    <script src="https://kit.fontawesome.com/91eada0414.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <div class="containerNav">
            <a href="#" class="logo">
                <img decoding="async" src="{{ asset('images/logo.png') }}" alt="Logo" />
            </a>
            <nav>
                <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
                <ul id="link">
                    <li><a href="/admin">Home</a></li>
                    <li><a class="active" href="{{ route('admin.orders.index', ['admin' => Auth::user()]) }}">Orders</a>
                    <li><a href="{{ route('admin.drivers.index', ['admin' => Auth::user()]) }}">Drivers</a></li>

                    </li>
                    <li><a href="{{ route('admin.orders.acceptedOrders', ['admin' => Auth::user()]) }}">Accepted
                            Orders</a>
                    </li>
                    <li><a href="/acceptreject">Manage Request</a></li>
                    <li class="logout">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="logout-button" type="submit"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i></button>
                        </form>
                    </li>

                    {{-- </ul>
                <div class="form">
                    <a href="cart.html"><i id="cart" class="fa-solid fa-cart-plus"
                            style="color: var(--dawn-pink) ;"></i></a>
                </div> --}}
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
    <div class="continer">
        <div class="content">
            @foreach ($orders as $order)
                <div class="order">
                    <div class="img">
                        <!--   <img src="images/miamed (1).png" alt class="image">  -->
                        <img src="{{ asset('images/images.png') }}" alt>
                    </div>

                    <div class="context">
                        <h4> order from <span class="company-name">
                                {{ $order['name'] }} </span> </h4>
                        <p> Address: {{ $order['address'] }} </p>
                        <p> TotalPrice: {{ $order['totalprice'] }} </p>
                        <div class="buttons">


                            <a href="{{ route('admin.orders.show', ['admin' => Auth::user(), 'order' => $order['id']]) }}"
                                onclick="editorder()" class="btn">see more</a>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <script src="{{ url('main.js') }}"></script>
</body>
