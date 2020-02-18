@extends('layouts.layout')
@section('content')
<h1>{{ __('Register') }}</h1>
@if ($errors->any())
<div class="errorblock">   
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="blocks">
    <div class="loginpanel">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <p class="pstreet"> <input id="name" type="text" placeholder="Name here.."  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus></p>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <p class="pstreet"> <input id="email" type="email" placeholder="Email here.." name="email" value="{{ old('email') }}" required autocomplete="email"></p>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <p class="pstreet"> <input id="password" type="password" placeholder="Password here.." name="password" required autocomplete="new-password"></p>
            </div>
            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                <p class="pstreet"><input id="password-confirm" type="password" placeholder="Confirm password.." name="password_confirmation" required autocomplete="new-password"></p>
            </div>
            <div class="form-group row">               
            </div>
            <div class="form-group row mb-0">
                <button type="submit" class="loginB" style="border:none; text-align: center;">
                {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
@endsection