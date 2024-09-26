<!DOCTYPE html>
<html lang="en">

<head>
    @vite('resources/css/app.css')

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home page</title>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="{{ url('Css/normalize.css') }}" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="{{ url('Css/all.min.css') }}" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="{{ url('Css/medcards.css') }}" />
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
</head>

<body>
    <!-- Start Header -->
    <header>
        <div class="container">
            <a href="#" class="logo">
                <img decoding="async" src="{{ asset('images/logo.png') }}" alt="Logo" />
            </a>
            <nav>
                <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
                <nav>
                    <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
                    <ul id="link">
                        <li><a href="/customer">Home</a></li>
                        @if (Auth::user())
                        <li><a href="{{ route('customer.orders.index', ['customer' => Auth::user()]) }}">Orders</a></li>
                        @else
                        <li><a href="/signin">Orders</a></li>
                        @endif

                        @if (Auth::user())
                        <li class="logout">
                            <form action="/logout" method="post">
                                @csrf
                                <button class="logout-button" type="submit"><i class="fa fa-sign-out"
                                        aria-hidden="true"></i></button>
                            </form>
                        </li>@else
                        <li><a class="logout-button" href="/signin"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        </li>
                        @endif
                    </ul>
                    <div class="form">
                        <!-- <i class="fa-sharp fa-solid fa-cart-shopping"></i> -->
                        @if (Auth::user())
                        <a href="{{ route('customer.cart.index', ['customer' => Auth::user()]) }}"><i id="cart"
                                class="fa-solid fa-cart-plus" style="color: var(--dawn-pink) ;"></i></a>
                        @else
                        <a href="/signin"><i id="cart" class="fa-solid fa-cart-plus"
                                style="color: var(--dawn-pink) ;"></i></a>
                        @endif
                        <!-- <i class="fa-solid fa-cart-arrow-down"></i> -->

                    </div>
                </nav>
        </div>
    </header>

    <body>

        <div class="search">
            <form class="search-form">
                <button id="search-button" onclick="show_textarea()" class="search-button"><i id="search-icon"
                        class="fa fa-search" aria-hidden="true"></i></button>
                <input id="textarea" class="search-text" type="text" placeholder="write here to search" name="search">
            </form>

        </div>
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
            <div class="card">
                <img src="{{ asset('storage' . '/' . $medicine->image) }}" />
                <div>
                    <h2>Name:
                        <br>
                        {{ $medicine->name }}
                    </h2>
                    <h3>Type: {{ $medicine->type }}</h3>
                    <p>
                        we have {{ $medicine->quantity }} pieces <br>
                        {{ $medicine->price }} s.p per one </p>
                    @if (Auth::user())
                    <form action="{{ route('customer.cart.store', ['customer' => Auth::user()->id]) }}" method="POST">
                        @csrf
                        <label for="">how many pieces you need</label>
                        <input class="quantity" name="medicine_id" value="{{ $medicine->id }}" type="number" hidden>
                        <input class="quantity" name="quantity" type="number" placeholder="">
                        <input onclick="light()" type="submit" class="btn" value="Add to cart">

                    </form> @else
                    <form action="" method="get">
                        <label for="">how many pieces you need</label>
                        <input class="quantity" name="medicine_id" value="{{ $medicine->id }}" type="number" hidden>
                        <input class="quantity" name="quantity" type="number" placeholder="">
                        <a href="/signin" class="btn">Add to cart</a>
                    </form> @endif

                </div>
            </div>
            @endforeach
            <div class="pages">
                {{ $medicines->links('') }}
            </div>
        </div>
        <script src="{{ url('main.js') }}"></script>
    </body>