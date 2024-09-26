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
    <link rel="stylesheet" href="{{ url('Css/leon.css') }}" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/91eada0414.js" crossorigin="anonymous"></script>
</head>

<body>
    @php

    @endphp
    <!-- Start Header -->
    <header>
        <div class="container">
            <a href="#" class="logo">
                <img decoding="async" src='images/logo.png' alt="Logo" />
            </a>
            <nav>
                <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
                <ul id="link">
                    <li><a class="active" href="/customer">Home</a></li>
                    @if (Auth::user())
                    <li><a href="{{ route('customer.orders.index', ['customer' => Auth::user()]) }}">Orders</a></li>
                    @else
                    <li><a href="/signin">Orders</a></li>
                    @endif
                    <li><a href="/customer/editProifile">Edit Profile</a></li>
                    @if (Auth::user())
                    <li class="logout">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="logout-button" type="submit"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i></button>
                        </form>
                    </li> @else
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
        <style>


        </style>
    </header>
    <!-- End Header -->

    <!-- start card -->
    <div class="companies">
        <div class="search">
            <form class="search-form">
                <button id="search-button" onclick="show_textarea()" class="search-button"><i id="search-icon"
                        class="fa fa-search" aria-hidden="true"></i></button>
                <input id="textarea" class="search-text" type="text" placeholder="write here to search" name="search">
            </form>

        </div>

        <div class="container">
            @foreach ($companies as $company)
            <div class="card">
                <img src="{{ asset('storage' . '/' . $company->logo) }}" alt="">
                <div class="caption">
                    <div class="company-name">{{ $company->name }}</div>
                    <div class="button"><a href="/customer/companies/{{ $company->id }}">show products</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <div>
        {{ $companies->links('vendor.pagination.simple-tailwind') }}
    </div>
    <script src="{{ url('main.js') }}"></script>
</body>

</html>