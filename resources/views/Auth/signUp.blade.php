<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign-in|sign-out</title>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="{{ url('Css/normalize.css') }}" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="{{ url('Css/all.min.css') }}" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="{{ url('Css/signup.css') }}" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="{{ url('Css/message.css') }}" />
    <script src="https://kit.fontawesome.com/91eada0414.js" crossorigin="anonymous"></script>
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
    <form class="form" method="post" enctype="multipart/form-data" action="/signup">
        @csrf
        <p class="title">Signup </p>
        <p class="wlcome">welcome to our website. </p>
        <div class="flex">
            <label>
                <input required="" placeholder="" type="text" class="input" name="firstname"
                    value="{{ old('firstname') }}">
                <span>Firstname</span>
                @error('firstname')
                <p class="error_message">
                    {{ $message }}
                </p>
                @enderror
            </label>

            <label>
                <input required="" placeholder="" type="text" class="input" name="lastname"
                    value="{{ old('lastname') }}">
                <span>Lastname</span>
                @error('lastname')
                <p class="error_message">
                    {{ $message }}
                </p>
                @enderror
            </label>
        </div>
        <label>
            <input required="" placeholder="" type="text" class="input" name="storename">
            <span>your pharmcy or store name </span>
            @error('storename')
            <p class="error_message">
                {{ $message }}
            </p>
            @enderror
        </label>
        <label>
            <input required="" placeholder="" type="email" class="input" name="email" value="{{ old('email') }}">
            <span>Email</span>
            @error('email')
            <p class="error_message">
                {{ $message }}
            </p>
            @enderror
        </label>

        <label>
            <input required="" placeholder="" type="password" class="input" name="password">
            <span>Password</span>
            @error('password')
            <p class="error_message">
                {{ $message }}
            </p>
            @enderror
        </label>
        <label>
            <input required="" placeholder="" type="number" class="input" name="phonenumber"
                value="{{ old('phonenumber') }}">
            <span>phone number</span>
            @error('phonenumber')
            <p class="error_message">
                {{ $message }}
            </p>
            @enderror
        </label>
        <label>
            <input required="" placeholder="" type="text" class="input" name="address" value="{{ old('address') }}">
            <span>address</span>
            @error('address')
            <p class="error_message">
                {{ $message }}
            </p>
            @enderror
        </label>
        <p class="choose">please choose what is your industry:</p>
        <div>
            <input type="radio" name="role" value="pharmacist" id="ph" onclick="insert()">
            <label for="ph">pharmacist</label>
            <input type="radio" name="role" value="beautystore" id="store" onclick="insert()">
            <label for="store">beauty store</label>
            @error('role')
            <p class="error_message">
                {{ $message }}
            </p>
            @enderror
        </div>
        <div id="certification">
            <p class="certificate"><b>please provide your certifcate</b></p>
            <input class="file" type="file" name="certificate">
            @error('certificate')
            <p class="error_message">
                {{ $message }}
            </p>
            @enderror
        </div>
        <button class="submit" id="submit" type="submit">Signup</button>
        <p class="signin" id="sign">Already have an acount ? <a href="/signin">Signin</a> </p>

    </form>
    <script src="{{ url('main.js') }}"></script>
</body>