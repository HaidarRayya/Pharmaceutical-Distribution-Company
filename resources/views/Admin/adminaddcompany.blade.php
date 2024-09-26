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
    <link rel="stylesheet" href="{{ url('Css/admin-edit-company.css') }}" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />

</head>

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
    <div class="table-companies">
        <form enctype="multipart/form-data" action="{{ route('companies.store') }}" method="POST">
            @csrf
            <table>
                <caption>
                    Company customer
                    <span class="table-row-count"></span>
                </caption>
                <thead>
                    <tr>
                        <th colspan="4">
                            <h2>Insert the company informations</h2>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="team-member-rows">
                    <!--? rows are generated -->
                    <tr>
                        <td rowspan="3" class="company-profile">
                            <img src="{{ asset('images/b2.jpg') }}" alt="">
                            <span class="profile-info">
                                <span class="profile-info__name">
                                    the informations will appear like this <br>
                                    company name
                                </span>
                                <span class="profile-info__alias">
                                    company@gmail.com
                                </span>
                            </span>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/unnamed.png') }}" alt="">
                        </td>
                        <td colspan="3">
                            <label for="email"> insert the company name: </label> <br>
                            <input class="edit" id="name" type="text" placeholder="the name" name="name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="error_message">
                                    {{ $message }}
                                </p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/gmail.jpg') }}" alt="">
                        </td>
                        <td colspan="3">
                            <label for="email"> insert the company email: </label> <br>
                            <input class="edit" id="email" type="email" placeholder="the email" name="email"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <p class="error_message">
                                    {{ $message }}
                                </p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/location.jpg') }}" alt="">
                        </td>
                        <td colspan="3">

                            <label for="location"> insert the company location: </label><br>
                            <input class="edit" id="location" type="text" placeholder="the location"
                                name="location" value="{{ old('location') }}" required>
                            @error('location')
                                <p class="error_message">
                                    {{ $message }}
                                </p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/logo2.png') }}" alt="">
                        </td>
                        <td colspan="3">
                            <label for="image"> insert the company logo: </label><br>
                            <input class="edit" id="image" type="file" placeholder="the logo" name="logo"
                                value="{{ old('logo') }}" required>
                            @error('logo')
                                <p class="error_message">
                                    {{ $message }}
                                </p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/phone-number.svg') }}"
                                alt=""> </td>
                        <td colspan="3">
                            <label for="phone"> insert the company phone: </label><br>
                            <input class="edit" id="phone" type="number" placeholder="the phone number"
                                name="phoneNumber" value="{{ old('phoneNumber') }}" required>
                            @error('phoneNumber')
                                <p class="error_message">
                                    {{ $message }}
                                </p>
                            @enderror
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="accrptReject">
                <a class="btn" href="/admin">back</a>
                <input type="submit" class="btn" value="Add COMPANY">
            </div>
        </form>

    </div>
    <script src="{{ url('main.js') }}"></script>

</body>

</html>
