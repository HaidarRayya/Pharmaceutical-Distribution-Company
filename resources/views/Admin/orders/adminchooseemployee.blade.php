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
    <link rel="stylesheet" href="{{ url('Css/admin-choose-employee.css') }}" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
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

    <div class="container">
        @foreach ( $drivers as $driver)

        <div class="card">
            <div class="infos">
                <div class="image">
                    <img class="driver-image"
                        src="{{ $driver->image ==null?asset('images/skills-01.jpg'): asset('storage/' . $driver->image)}}"
                        alt="">
                </div>
                <div class="info">
                    <div>
                        <p class="name">
                            {{ $driver->firstname .' '. $driver->lastname}}
                        </p>
                    </div>
                    <div class="stats">
                        <p class="flex flex-col">
                            Mail
                            <span class="state-value">
                                {{ $driver->email }} </span>
                        </p>
                        <p class="flex">
                            phone
                            <span class="state-value">
                                {{ $driver->phonenumber }}
                            </span>
                        </p>

                    </div>
                </div>
            </div>
            <form action="/admin/accept/{{ $order_id}}/{{ $driver->id}}" method="post">
                @csrf
                <button class="choose" type="submit">
                    Choose
                </button>
            </form>

        </div>
        @endforeach

        <div class="nav-buttons">
            {{ $drivers->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>

</body>