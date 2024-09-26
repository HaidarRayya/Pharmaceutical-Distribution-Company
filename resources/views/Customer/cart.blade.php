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
    <link rel="stylesheet" href="{{ url('Css/cart.css') }}" />
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <style>
        /* .error-message {
      position: absolute;
      // display: none !important;
      color: black;
      width: 200px;
      height: 200px;
      left: calc(50% - 100px);
      top: calc(50% - 100px);
      background-image: linear-gradient(to right, var(--color5), var(--color7));
      text-align: center;
      padding: 10px;
      border-radius: 5%;
      display: grid;
      grid-template-rows: auto 1fr auto;
      font-size: 20px;
    }

    .error-message button {
      background-color: var(--color6);
      color: var(--color7);
      border-radius: 10%;
      justify-self: center;
    }*/
    </style>
</head>

<body>
    <!-- Start Header -->
    <header>
        <div class="container">
            <a href="#" class="logo">
                <img decoding="async" src={{ asset('images/logo.png') }} alt="Logo" />
            </a>
            <nav>
                <!-- <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i> -->
                <ul id="link">
                    <li><a href="/customer">Home</a></li>
                    <li><a href="{{ route('customer.orders.index', ['customer' => Auth::user()]) }}">Orders</a></li>

                    <li class="logout">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="logout-button" type="submit"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i></button>
                        </form>
                    </li>
                </ul>
                <div class="form">
                    <a href="{{ route('customer.cart.index', ['customer' => Auth::user()]) }}"><i id="cart"
                            class="fa-solid fa-cart-plus" style="color: var(--dawn-pink) ;"></i></a>
                </div>
            </nav>
        </div>
    </header>

    <body>
        <div class="content">
            @if (session()->has('message'))
            <div class="Message" id="Message">
                <div class="Message-icon">
                    <i class="fa fa-bell-o"></i>
                </div>
                <div class="Message-body">
                    <p> {{ session('message') }} </p>
                    <button value="Message" value="Message" onclick="Message()"
                        class="Message-button js-messageClose">close
                    </button>
                </div>
            </div>
            @endif
            @foreach ($medicines as $medicine)
            <div class="card" id="carte">
                <img src="{{ asset('storage' . '/' . $medicine['image']) }}" />
                <div class="con">
                    <h2>{{ $medicine['name'] }}</h2>
                    <p>Number of pieces: {{ $medicine['cart']->quantity }}, Total
                        price:{{ $medicine['cart']->price * $medicine['cart']->quantity }} </p>
                    <form
                        action="{{ route('customer.cart.destroy', ['customer' => Auth::user()->id, 'cart' => $medicine['cart']->id]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" onclick="remove1()" class="btn" value="Delete">
                    </form>
                    <a href="{{ route('customer.cart.edit', ['customer' => Auth::user()->id, 'cart' => $medicine['cart']->id]) }}"
                        class="btn3">Edit</a>
                </div>
            </div>
            @endforeach

        </div>
        <form action="/confirmOrder" method="post">
            @csrf
            <input type="submit" value="send order" class="btn2">
        </form>


        <script src="{{ url('main.js') }}"></script>
    </body>