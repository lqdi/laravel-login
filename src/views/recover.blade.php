{{-- Created by anderson.mota on 12/11/2014. --}}
@extends('laravel-login::layout')
@section('laravel-login::content')
    <form action="" method="post" class="form-signin">
        <div class="form-group">
            <label for="inputPassword">{{Lang::get('laravel-login::labels.new_password')}}:</label>
            <input type="password" id="inputPassword" class="form-control" name="password" />
        </div>
        <div class="form-group">
            <label for="inputConfirmPassword">{{Lang::get('laravel-login::labels.confirm_password')}}:</label>
            <input type="password" id="inputConfirmPassword" class="form-control" name="password_confirmation"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-save"></i>&nbsp;{{Lang::get('laravel-login::labels.create_password')}}</button>
        </div>
        <a href="{{route('authenticate')}}" class="right"><i class="fa fa-angle-double-left"></i>&nbsp;{{Lang::get('laravel-login::labels.login')}}</a>
    </form>
@stop