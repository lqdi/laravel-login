{{-- Created by anderson.mota on 12/11/2014. --}}
@extends('laravel-login::layout')
@section('laravel-login::content')
<div class="row">
    <div class="large-6 large-centered columns">
        <form action="{{route('authenticate')}}" method="post" accept-charset="utf-8">
            <div>
                <label for="inputEmail">{{Lang::get('laravel-login::labels.email')}}:</label><input type="text" name="email" id="inputEmail"><small></small>
            </div>
            <div>
                <label for="inputPassword">{{Lang::get('laravel-login::labels.password')}}:</label><input type="password" name="password" id="inputPassword"><small></small>
            </div>
            <p class="text-center">
                <label for="inputRemember"><input name="remember" type="checkbox" checked id="inputRemember">
                    <span class="custom checkbox checked"></span> {{Lang::get('laravel-login::labels.remember')}}</label>
            </p>
            <button type="submit"><i class="fa fa-lock"></i>&nbsp;{{Lang::get('laravel-login::labels.entry')}}</button>
        </form>
        <p class="text-center"><a href="{{route('authenticate.forgot')}}">{{Lang::get('laravel-login::labels.forgot_your_password')}}</a></p>
    </div>
</div>
@stop