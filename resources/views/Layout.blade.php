<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="@yield('css')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <ul class="nav justify-content-end">

        @guest
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Register</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
        @endguest

        @auth

            <li class="nav-item " style="position:sticky">
                <a class="nav-link active" aria-current="page" href="{{ route('storeForm') }}">Add A New Post</a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Welcome {{ Auth::user()->firstName }}</a>

                <ul class="dropdown-menu">

                    <li class="nav-item">

                        <form action="{{ route('logoutProcess') }}" method="POST">
                            @csrf
                            <button type="submit" style="background-color: red">Logout</button>
                        </form>

                    </li>
                </ul>

            @endauth

    </ul>

    @if (session()->has('success'))
        <div class="container w-50">
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        </div>
    @endif

    @yield('body')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>

</html>
