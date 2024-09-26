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
    <link rel="stylesheet" href="{{ url('Css/admin-add-newemployee.css') }}" />

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
    <form action="{{ route('admin.drivers.store', ['admin' => Auth::user()]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="table-companies">
            <table>
                <caption>
                    Company Employees
                    <span class="table-row-count"></span>
                </caption>
                <!-- <thead>
     <tr>
      <th colspan="4"><h2>insert new employee informations</h2>  </th>
      <th></th>
      <th></th>
      <th></th>
     </tr>
    </thead> -->
                <tbody id="team-member-rows">
                    <!--? rows are generated -->
                    <tr>
                        <td rowspan="3" class="company-profile">
                            <img src=" {{ asset('images/b2.jpg') }}" alt="">
                            <span class="profile-info">
                                <span class="profile-info__name">
                                    insert new employee informations
                                </span>
                                <span class="profile-info__alias">

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

                            <label for="location"> insert the new employee first name : </label><br>
                            <input class="edit" id="location" type="text"
                                placeholder="the new employee first name" name="firstname" required>
                        </td>
                        @error('firstname')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                        @enderror
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/unnamed.png') }}" alt="">
                        </td>
                        <td colspan="3">

                            <label for="location"> insert the new employee last name : </label><br>
                            <input class="edit" id="location" type="text" placeholder="the new employee last name"
                                name="lastname" required>
                        </td>
                        @error('lastname')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                        @enderror
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/7080646.png') }}" alt="">
                        </td>
                        <td colspan="3">
                            <label for="location"> insert the new employee password : </label><br>
                            <input class="edit" id="location" type="text" placeholder="the new employee password"
                                name="password" required>
                        </td>
                        @error('password')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                        @enderror

                    </tr>

                    <tr>
                        <td class="company-profile img"> <img src=" {{ asset('images/phone-number.svg') }}"
                                alt="">
                        </td>
                        <td colspan="3">
                            <label for="image"> insert the new employee phone number: </label><br>
                            <input class="edit" id="image" type="number"
                                placeholder="the new employee phone number" name="phonenumber" required>
                        </td>
                        @error('phonenumber')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                        @enderror
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src=" {{ asset('images/gmail.jpg') }}" alt="">
                        </td>
                        <td colspan="3">
                            <label for="image"> insert the new employee email: </label><br>
                            <input class="edit" id="email" type="email" placeholder="the new employee email"
                                name="email" required>
                        </td>
                        @error('email')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                        @enderror
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/skills-01.jpg') }}" alt="">
                        </td>
                        <td colspan="3">
                            <label for="image"> insert the new employee photo: </label><br>
                            <input class="edit" id="email" type="file" placeholder="the new employee photo"
                                name="image">
                        </td>
                        @error('image')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                        @enderror
                    </tr>
                </tbody>
            </table>
            <input hidden name="role" value="driver" id="ph" onclick="insert()">

            <div class="buuttons">

                <a class="btn" href="{{ route('admin.drivers.index', ['admin' => Auth::user()]) }}">back</a>

                <input type="submit" onclick="light()" class="btn" value="insert">
            </div>
    </form>

    </div>
    <script src="{{ url('main.js') }}"></script>

</body>

</html>
