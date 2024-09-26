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
  <link rel="stylesheet" href="{{ url('Css/order-to-driver.css') }}" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ url('Css/message.css') }}" />

</head>

<body>
  <header>
    <div class="container">
      <a href="#" class="logo">
        <img decoding="async" src="{{ asset('images/logo.png') }}" alt="Logo" />
      </a>
      <nav>
        <i id="toggle" onclick="show_toggle()" class="fas fa-bars toggle-menu"></i>
        <ul id="link">
          <li><a class="active" href="/driver">Home</a></li>
          <li><a  href="/driver/editProifile">Edit Profile</a></li>

          <li class="logout">
            <form action="/logout" method="post">
              @csrf
              <button class="logout-button" type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
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
  <div class="content">
    @foreach ($orders as $order )

    <div class="order-cart">
      <h1> Order to {{ $order['name'] }}</h1>
      <p class="text">their phone number: {{ $order['phonenumber'] }}</p>
      <p class="text">the cost of this order is : {{ $order['totalprice'] }}</p>
      @if($order['status']==2)
      <form action="/driver/{{  $order['id']}}/start" method="post">
        @csrf
        <input type="submit" onclick="editorder()" class="btn" value="Start delivering">
      </form>
      @else
      <form action="/driver/{{  $order['id']}}/done" method="post">
        @csrf
        <input type="submit" onclick="editorder()" class="btn" value="DONE ">
      </form>
      @endif


    </div>
    @endforeach

  </div>
  <script src="main.js"></script>
</body>