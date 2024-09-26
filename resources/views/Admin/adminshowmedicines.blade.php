<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    @vite('resources/css/app.css')

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home page</title>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="{{ url('Css/normalize.css') }}" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="{{ url('Css/all.min.css') }}" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="{{ url('Css/adminshowmedcine.css') }}" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />
    <script src="https://kit.fontawesome.com/91eada0414.js" crossorigin="anonymous"></script>

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
                    <li><a href="/admin">Home</a></li>
                    <li><a href="{{ route('admin.orders.index', ['admin' => Auth::user()]) }}">Orders</a></li>
                    <li><a href="{{ route('companies.medicines.create', ['company' => $company]) }}">Add Medicine</a>
                    </li>

                    <li class="logout">
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <body>
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
        <div class="search">
            <form class="search-form">
                <button id="search-button" onclick="show_textarea()" class="search-button"><i id="search-icon"
                        class="fa fa-search" aria-hidden="true"></i></button>
                <input id="textarea" class="search-text" type="text" placeholder="write here to search" name="search">
            </form>

        </div>
        <div class="content">

            @foreach ($medicines as $medicine)
            <div class="card">
                <img src="{{ asset('storage' . '/' . $medicine->image) }}" />
                <div>
                    <h2>{{ $medicine->name }}</h2>
                    <!--<h3>for kids only</h3> -->

                    <p>
                        we have {{ $medicine->quantity }} pieces <br>
                        {{ $medicine->price }} s.p per one </p>
                    <div>
                        <br>
                        <a class="btn"
                            href="{{ route('companies.medicines.edit', [$medicine->company_id, $medicine->id]) }}">
                            Edit
                            Medicine</a>
                    </div>
                    <br>
                    <form method="POST"
                        action="{{ route('companies.medicines.destroy', [$medicine->company_id, $medicine->id]) }}">
                        @csrf
                        @method('delete')
                        <input class="btn3" type="submit" value="Delete medicine">
                    </form>

                </div>
            </div>
            @endforeach
        </div>
        <div class="back-next">
            <div class="next">
                {{ $medicines->links('vendor.pagination.simple-tailwind') }}
            </div>
        </div>

        <script src="{{ url('main.js') }}"></script>
    </body>

</html>