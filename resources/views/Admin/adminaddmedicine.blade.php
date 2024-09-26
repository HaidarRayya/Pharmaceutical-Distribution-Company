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
    <link rel="stylesheet" href="{{ url('Css/admin-add-medicine.css') }}" />
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
        <form action="{{ route('companies.medicines.store', ['company' => $company->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <table>
                <caption>
                    Company Mdecines
                    <span class="table-row-count"></span>
                </caption>
                <thead>
                    <tr>
                        <th colspan="4">
                            <h2>Insert the Mdecine informations</h2>
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
                            <img src="images/b2.jpg" alt="">
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
                        <td class="company-profile img"> <img src="{{ asset('images/images (1).png') }}" alt=""
                                width="15px"> </td>
                        <td colspan="3">
                            <label for="email"> insert the Medicine Name: </label> <br>
                            <input class="edit" id="email" type="text" name="name" placeholder="the Mdecine name"
                                required>
                        </td>
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src=" {{ asset('images/price-image.png') }}" alt="">
                        </td>
                        <td colspan="3">

                            <label for="location"> insert the Medicine price: </label><br>
                            <input class="edit" id="location" type="number" name="price"
                                placeholder="the Medicine price" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src="{{ asset('images/logo2.png') }}" alt="">
                        </td>
                        <td colspan=" 3">
                            <label for="image"> insert the Medicine Image: </label><br>
                            <input class="edit" id="image" type="file" name="image" placeholder="the Medicine Image"
                                required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <p class="choose">please choose the type:</p>
                            <div>
                                <input type="radio" name="type" value="cosmetic" id="ph" onclick="insert()">
                                <label for="ph">Cosmetic</label>
                                <input type="radio" name="type" value="pharmaceutical" id="store" onclick="insert()">
                                <label for="store">Pharmaceutical</label>
                                @error('type')
                                <p class="error_message">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="company-profile img"> <img
                                src=" {{ asset('images/360_F_402038709_BdW8bxsSIbeW64cNJb4cCOyBFag5cBed.jpg') }}"
                                alt=""> </td>
                        <td colspan="3">
                            <label for="phone"> insert the Medicine quantity: </label><br>
                            <input class="edit" id="phone" type="number" name="quantity"
                                placeholder="the Medicine quantity" required>
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="buuttons">
                <a class="btn" href="{{ route('companies.medicines.index', ['company' => $company->id]) }}">back</a>
                <input type="submit" class="btn" value="Add">
            </div>
        </form>

    </div>
    <script src="{{ url('main.js') }}"></script>

</body>

</html>