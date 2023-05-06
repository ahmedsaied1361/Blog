@extends('Layout')

@section('title')
    Registration
@endsection

@section('css')
    {{ asset('error.css') }}
@endsection

@section('body')
    <div class="container w-50" style="border: 1px solid">

        <h1>Registration Form</h1>

        <form action="{{ route('registration') }}" method="post" style="padding: 20px">

            @csrf

            <label for="inputEmail5" class="form-label">First Name</label>
            <input name="firstName" type="text" id="inputEmail5" class="form-control" aria-labelledby="emailHelpBlock">

            <div class="error">
                @error('firstName')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>

            <label for="inputEmail5" class="form-label">Last Name</label>
            <input name="lastName" type="text" id="inputEmail5" class="form-control" aria-labelledby="emailHelpBlock">
            <div class="error">
                @error('lastName')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <label for="inputEmail5" class="form-label">Email</label>
            <input name="email" type="email" id="inputEmail5" class="form-control" aria-labelledby="emailHelpBlock">
            <div class="error">
                @error('email')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <label for="inputPassword5" class="form-label">Password</label>
            <input name="password" type="password" id="inputPassword5" class="form-control"
                aria-labelledby="passwordHelpBlock">

            <div class="error">
                @error('password')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>

            <label for="inputPassword5" class="form-label">Password Confirmation</label>
            <input name="password_confirmation" type="password" id="inputPassword5" class="form-control"
                aria-labelledby="passwordHelpBlock">

            <button type="submit">Register</button>

        </form>

    </div>
@endsection
