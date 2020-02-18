@extends('layouts.layout')
@section('content')
<h1>{{ __('Login') }}</h1>
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
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="loginpanel">
            <label for="email" >{{ __('E-Mail Address') }}</label>
            <div >
                <p class="pstreet"><input id="email" type="email"   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email here.."></p>
            </div>
            <div class="form-group row">
                <label for="password" >{{ __('Password') }}</label>
                <div class="col-md-6">
                    <p class="pstreet"> <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password here.."></p>
                </div>
            </div>
            <div class="form-group row">             
                <label  for="remember">
                    {{ __('Remember Me') }}
                </label>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>             
            </div>
            <div class="form-group row mb-0">
                <button type="submit" class="loginB" style="border:none;">
                {{ __('Login') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection