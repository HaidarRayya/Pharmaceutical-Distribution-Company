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
    <link rel="stylesheet" href="{{ url('Css/admin-table.css') }}" />
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
                <img decoding="async" src="images/logo.png" alt="Logo" />
            </a>
            <nav>
                <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
                <ul id="link">
                    <li><a class="active" href="/admin">Home</a></li>
                    <li><a href="{{ route('admin.orders.index', ['admin' => Auth::user()]) }}">Orders</a></li>
                    <li><a href="{{ route('admin.drivers.index', ['admin' => Auth::user()]) }}">Drivers</a></li>
                    <li><a href="/acceptreject">Manage Request</a></li>
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
    @if (session()->has('confirmMessage'))
    <div class="Message" id="Message">
        <div class="Message-icon">
            <i class="fa fa-bell-o"></i>
        </div>
        <div class="Message-body">
            <p> {{ session('confirmMessage') }} </p>
            <form action="companies/confirmDestroy/{{ Session::get('company') }}" method="po">
                @csrf
                @method('delete')
                <button type="submit" value="Message" value="Message" onclick="Message()"
                    class="Message-button js-messageClose">Delete
                </button>
            </form>
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
    <div class="st">

        <div class="table-widget">
            <table>
                <caption>
                    Company Customers
                    <span class="table-row-count"></span>
                    <a class="add" href="{{ route('companies.create') }}"> add new company</a>
                </caption>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="team-member-rows">
                    <!--? rows are generated -->
                    @foreach ($companies as $company)
                    <tr>
                        <td class="team-member-profile">
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="">
                            <span class="profile-info">
                                <span class="profile-info__name">
                                    {{ $company->name }}
                                </span>
                                <span class="profile-info__alias">
                                    {{ $company->email }}
                                </span>
                            </span>
                        </td>
                        <td>
                            <a class="show"
                                href="{{ route('companies.medicines.index', ['company' => $company->id]) }}">show</a>
                        </td>
                        <td>
                            <a class="edit" href="{{ route('companies.edit', ['company' => $company->id]) }}">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('companies.destroy', ['company' => $company->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input class="delete" type="submit" value="delete">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="nav-buttons">
                {{ $companies->links('vendor.pagination.simple-tailwind') }}
            </div>

        </div>


    </div>
    <script src="{{ url('main.js') }}"></script>
</body>

</html>