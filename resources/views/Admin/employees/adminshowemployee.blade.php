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
    {{-- <link rel="stylesheet" href="{{ url('Css/remove-employee.css') }}" /> --}}
    <link rel="stylesheet" href="{{ url('Css/admin-show-employee.css') }}" />
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
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
                    <li><a href="/admin">Home</a></li>
                    <li><a href="{{ route('admin.orders.index', ['admin' => Auth::user()]) }}">Orders</a></li>
                    <li><a class="active"
                            href="{{ route('admin.drivers.index', ['admin' => Auth::user()]) }}">Drivers</a></li>
                    <li><a href="{{ route('admin.drivers.create', ['admin' => Auth::user()]) }}">Add
                            Driver</a></li>

                    <li><a href="/acceptreject">Manage Request</a></li>
                    <li class="logout">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="logout-button" type="submit"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i></button>
                        </form>
                    </li>

                </ul>
                {{-- <div class="form">
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
    <div class="container">
        @foreach ($drivers as $driver)
            <div class="card">
                <div class="card-border-top">
                </div>
                <div class="img">
                    <img class="driver-image"
                        src="{{ $driver->image == null ? asset('images/skills-01.jpg') : asset('storage/' . $driver->image) }}"
                        alt="">
                </div>
                <span> {{ $driver->firstname . ' ' . $driver->lastname }}</span>
                <p class="job"> Driver</p>
                <div class="buttons">
                    <form
                        action="{{ route('admin.drivers.destroy', ['admin' => Auth::user(), 'driver' => $driver->id]) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                        <input class="button2" type="submit" value="remove">
                    </form>
                    <a class="button"
                        href="{{ route('admin.drivers.edit', ['admin' => Auth::user(), 'driver' => $driver->id]) }}">details</a>
                </div>
            </div>
        @endforeach
        <div class="nav-buttons">
            {{ $drivers->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
    </div>
    <script src="{{ url('main1.js') }}"></script>
    <script src="{{ url('main.js') }}"></script>

</body>
