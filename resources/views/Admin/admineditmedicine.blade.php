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
    <link rel="stylesheet" href="{{ url('Css/admin-edit-medicine.css') }}" />
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
        <form enctype="multipart/form-data" method="POST"
            action="{{ route('companies.medicines.update', [$medicine->company_id, $medicine->id]) }}">
            @csrf
            @method('put')
            <table>
                <caption>
                    Company Medicines
                    <span class="table-row-count"></span>
                </caption>
                <thead>
                    <tr>
                        <th colspan="4">
                            <h2>edit this Medicine informations</h2>
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
                            <img src="{{ asset('storage/' . $medicine->image) }}" alt="">
                            <span class="profile-info">
                                <span class="profile-info__name">
                                    Medicine Name: {{ $medicine->name }}
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
                        <td class="company-profile img"> <img src="{{ asset('images/unnamed.png') }}" alt=""
                                width="15px"> </td>
                        <td colspan="3">
                            <label for="email"> insert the Medicine Name: </label> <br>
                            <input class="edit" id="email" type="text" name="name" placeholder="the Mdecine name"
                                value="{{ $medicine->name }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img
                                src="{{ asset('images/360_F_402038709_BdW8bxsSIbeW64cNJb4cCOyBFag5cBed.jpg') }} "
                                alt=""> </td>
                        <td colspan="3">
                            <label for="email"> update the Medicine quantity: </label> <br>
                            <input class="edit" id="email" type="number" name="quantity"
                                value="{{ $medicine->quantity }}" placeholder="the new quantity" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img src=" {{ asset('images/price-image.png') }}" alt=""> </td>
                        <td colspan="3">

                            <label for="location"> update the company price: </label><br>
                            <input class="edit" id="location" type="number" name='price' value="{{ $medicine->price }}"
                                placeholder="the new price" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="company-profile img"> <img
                                src=" {{ asset('images/pngtree-drug-public-medical-illustration-image_1427032.jpg') }}"
                                alt=""> </td>
                        <td colspan="3">
                            <label for="image"> update the medicine logo: </label><br>
                            <input class="edit" id="image" type="file" name='image' placeholder="the new logo" required>
                            <span><img src="{{ asset('storage/' . $medicine->image) }}" alt="" width="50"
                                    height="100"></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="buuttons">
                <a class="btn" href="{{ route('companies.medicines.index', ['company' => $company->id]) }}">back</a>
                <input type="submit" class="btn" value="Update">

            </div>
        </form>
        <script src="{{ url('main.js') }}"></script>

    </div>
</body>

</html>