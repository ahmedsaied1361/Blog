@extends('Layout')

@section('title')
    Rest
@endsection

@section('css')
    {{ asset('error.css') }}
@endsection

@section('body')
    <div class="container w-50" style="border: 1px solid">

        <h1>Rest Password Form</h1>

        <form action="{{ route('restProcess') }}" method="post" style="padding: 20px">

            @csrf

            <label for="inputEmail5" class="form-label">Email</label>
            <input name="email" type="email" id="inputEmail5" class="form-control" aria-labelledby="emailHelpBlock">
            <div class="error">

                @error('email')
                    {{ $message }}
                @enderror
            </div>

            <label for="inputPassword5" class="form-label">New Password</label>
            <input name="password" type="password" id="inputPassword5" class="form-control"
                aria-labelledby="passwordHelpBlock">

            <div class="error">
                @error('password')
                    {{ $message }}
                @enderror
            </div>

            <label for="inputPassword5" class="form-label">New Password Confirmation</label>
            <input name="password_confirmation" type="password" id="inputPassword5" class="form-control"
                aria-labelledby="passwordHelpBlock">

            <button type="submit">Submit</button>

        </form>

    </div>
@endsection
