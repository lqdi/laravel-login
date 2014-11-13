{{-- Created by anderson.mota on 12/11/2014. --}}
@extends('laravel-login::layout')
@section('laravel-login::content')
    <form class="form-signin" role="form" action="{{route('authenticate')}}" method="post" accept-charset="utf-8">
        <h2 class="form-signin-heading">{{Lang::get('laravel-login::labels.login_title')}}</h2>
        <label for="inputEmail" class="sr-only">{{Lang::get('laravel-login::labels.email')}}</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="{{Lang::get('laravel-login::labels.email')}}" required autofocus>
        <label for="inputPassword" class="sr-only">{{Lang::get('laravel-login::labels.password')}}</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="{{Lang::get('laravel-login::labels.password')}}" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me" name="remember" checked> {{Lang::get('laravel-login::labels.remember')}}
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-lock"></i>&nbsp;{{Lang::get('laravel-login::labels.entry')}}</button>
    </form>
    <p class="text-center"><a href="{{route('authenticate.forgot')}}">{{Lang::get('laravel-login::labels.forgot_your_password')}}</a></p>
@stop