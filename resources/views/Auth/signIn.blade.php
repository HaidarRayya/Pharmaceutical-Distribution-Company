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
    <link rel="stylesheet" href="{{ url('Css/signin.css') }}" />
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
    <form class="form" method="POST" action="/signin">
        @csrf
        <p class="title">login</p>
        <p class="wlcome">welcome to our website. </p>
        <label>
            <input required="" placeholder="" type="email" class="input" value="{{ old('email') }}" name="email">
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
        <button class="submit" id="submit">login</button>
        <p class="signin" id="sign"> if you don't have an account.. <a href="/signupPage">Signup</a> </p>
        <p class="signin" id="sign"><a href="/inputEmailPage">Forget Password</a> </p>

    </form>
    <script src="{{ url('main.js') }}"></script>
</body>