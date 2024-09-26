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
    <link rel="stylesheet" href="{{ url('Css/driver-update-info.css') }}" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
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
        <form action="/driver/editProifile" method="POST" enctype="multipart/form-data">
            @csrf

            <table>
                <caption>
                    Employee informations
                    <span class="table-row-count"></span>
                </caption>
                <thead>
                    <tr>
                        <th colspan="4">
                            <h2>update your informations</h2>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="team-member-rows">
                    <!--? rows are generated -->

                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/images (1).png') }}" alt="">
                        </td>
                        <td colspan="3">
                            <label for="email"> update your first name: </label> <br>
                            <input class="edit" id="email" type="text" placeholder="the new first name"
                                name='firstname' value="{{ $user->firstname }}" required>
                        </td>
                        @error('firstname')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                        @enderror
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/images (1).png') }}" alt="">
                        </td>
                        <td colspan="3">
                            <label for="email"> update your last name: </label> <br>
                            <input class="edit" id="email" type="text" placeholder="the new last name"
                                name='lastname' value="{{ $user->lastname }}" required>
                            @error('lastname')
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
                            <label for="email"> update your email: </label> <br>
                            <input class="edit" id="email" type="email" placeholder="the new email"
                                name='email' value="{{ $user->email }}" required>
                            @error('email')
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
                            <label for="email"> update your password: </label> <br>
                            <input class="edit" id="email" type="text" placeholder="the new password"
                                name='password'>
                            @error('password')
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
                            <label for="image"> update your picture: </label><br>
                            <input class="edit" id="image" type="file" placeholder="the new picture"
                                name='image'>
                            <div class="img">
                                <img class="driver-image"
                                    src="{{ $user->image == null ? asset('images/skills-01.jpg') : asset('storage/' . $user->image) }}"
                                    alt="">
                            </div>
                            @error('image')
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
                            <label for="phone"> update your phone number: </label><br>
                            <input class="edit" id="phone" type="number" placeholder="the new phone number"
                                name='phonenumber' value="{{ $user->phonenumber }}" required>
                        </td>
                        @error('phonenumber')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                        @enderror
                    </tr>

                </tbody>
            </table>
            <div class="buttons">
                <a class="btn" href="/driver">back</a>
                <input type="submit" onclick="light()" class="btn" value="Update">
            </div>
        </form>

    </div>
    <script src="{{ url('main.js') }}"></script>

</body>

</html>
