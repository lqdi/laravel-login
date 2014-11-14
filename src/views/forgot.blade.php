{{-- Created by anderson.mota on 12/11/2014. --}}
@extends('laravel-login::layout')
@section('laravel-login::content')
    <form class="form-signin" method="post">
        <p class="box-message">Digite seu nome de usuário ou endereço de email. Você receberá um link para criar uma nova senha via email.</p>
        <div class="form-group">
            <label for="inputEmail">{{Lang::get('laravel-login::labels.email')}}:</label>
            <input type="email" name="email" id="inputEmail" required="" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-gear"></i>&nbsp;{{Lang::get('laravel-login::labels.generate_password')}}</button>
        </div>
        <p><a href="{{route('authenticate')}}" class="right"><i class="fa fa-angle-double-left"></i>&nbsp;{{Lang::get('laravel-login::labels.login')}}</a></p>
    </form>
@stop