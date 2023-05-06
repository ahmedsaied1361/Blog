@extends('Layout')

@section('title')
    Login
@endsection

@section('css')
{{ asset('error.css') }}
@endsection

@section('body')
    <div class="container w-50" style="border: 1px solid">

        <h1>Login Form</h1>

        <form action="{{ route('loginProcess') }}" method="post" style="padding: 20px">

            @csrf

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

            <a href="{{ route('rest') }}">Reset Password</a><br>

            <button type="submit">Login</button>

        </form>

    </div>
@endsection
