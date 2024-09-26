<!DOCTYPE html>
<html lang="en">

<head>
    @vite('resources/css/app.css')

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home page</title>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="css/accept-reject.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />
    <script src="https://kit.fontawesome.com/91eada0414.js" crossorigin="anonymous"></script>
</head>

<body>

    <header>
        <div class="containerNav">
            <a href="#" class="logo">
                <img decoding="async" src="images/logo.png" alt="Logo" />
            </a>
            <nav>
                <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
                <ul id="link">
                    <li><a href="{{ route('admin.index') }}">Home</a></li>
                    <li><a href="{{ route('admin.orders.index', ['admin' => Auth::user()]) }}">Orders</a></li>
                    <li><a class="active" href="/acceptreject">Manage Request</a></li>
                    <li><a href="{{ route('admin.drivers.index', ['admin' => Auth::user()]) }}">Drivers</a></li>

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
        @foreach ($users as $user)
        <div class="card">
            <div class="card_image"></div>
            <div class="card_text">
                <img src=" {{ asset('storage/' . $user->certificate) }}" alt="" srcset="" width="200" height="200">
                <h4 class="space">{{ $user->role }}</h4>

                <p class="space"><b> Name:</b>{{ $user->firstname . ' ' . $user->lastname }}</p>

                <p class="space"><b> address:</b>{{ $user->address }}</p>

                <div class="accrptReject">
                    <form action="/accept/{{ $user->id }}" method="POST">
                        @csrf
                        <input type="text" value="" hidden>
                        <input type="submit" value="accept" class="btn">
                    </form>
                    <form action="/reject/{{ $user->id }}" method="POST">
                        @csrf
                        <input type="submit" value="reject" class="btn2">
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div>
        {{ $users->links('vendor.pagination.simple-tailwind') }}
    </div>

    </div>


    </div>
    <script src="{{ url('main.js') }}"></script>
</body>

</html>