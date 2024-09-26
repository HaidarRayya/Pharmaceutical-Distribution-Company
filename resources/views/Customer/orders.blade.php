<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home page</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('Css/normalize.css') }}" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="{{ url('Css/all.min.css') }}" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="{{ url('Css/orders-customer.css') }}" />
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />
</head>

<body>
    <header>
        <div class="container">
            <a href="#" class="logo">
                <img decoding="async" src={{ asset('images/logo.png') }} alt="Logo" />
            </a>
            <nav>
                <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
                <ul id="link">
                    <li><a href="/customer">Home</a></li>
                    <li><a class="active"
                            href="{{ route('customer.orders.index', ['customer' => Auth::user()]) }}">Orders</a></li>

                    <li class="logout">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="logout-button" type="submit"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i></button>
                        </form>
                    </li>
                </ul>
                <div class="form">
                    <!-- <i class="fa-sharp fa-solid fa-cart-shopping"></i> -->
                    <a href="{{ route('customer.cart.index', ['customer' => Auth::user()]) }}"><i id="cart"
                            class="fa-solid fa-cart-plus" style="color: var(--dawn-pink) ;"></i></a>

                    <!-- <i class="fa-solid fa-cart-arrow-down"></i> -->

                </div>
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
    <div class="orders-continer">


        @foreach ($orders as $order)
        <div class="content">
            <div class="order-cart">
                <h2>Date: {{ $order->date }}</h2>
                <h3>Status:
                    @if ($order->status == 0)
                    {{ 'Waiting Accept' }}
                    @elseif ($order->status == 1)
                    {{ 'waiting for preparing' }}
                    @elseif ($order->status == 2)
                    {{ 'waiting for delivery' }}
                    @elseif ($order->status == 3)
                    {{ 'under delivery' }}
                    @elseif ($order->status == 4)
                    {{ 'delivered' }}
                    @else
                    @endif

                </h3>

                <p>the cost of this order is :{{ $order->totalprice }} s.p</p>
                <p>you can edit or cancel your order in 24 hours after you send it</p>
                <div class="buttons">
                    <a class="showdetails-btn"
                        href="{{ route('customer.orders.show', ['customer' => Auth::user(), 'order' => $order->id]) }}"
                        onclick="editorder()" class="btn">show details</a>
                    <form
                        action="{{ route('customer.orders.destroy', ['customer' => Auth::user(), 'order' => $order->id]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" onclick="editorder()" class="btn" value="Delete">
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <script src="{{ url('main.js') }}"></script>
</body>