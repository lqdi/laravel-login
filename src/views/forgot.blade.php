{{-- Created by anderson.mota on 12/11/2014. --}}
@extends('laravel-login::layout')
@section('laravel-login::content')
    <form class="form-signin" method="post">
        <div class="form-group">
            <label for="inputEmail">{{Lang::get('laravel-login::labels.email')}}:</label>
            <input type="email" name="email" id="inputEmail" required="" class="form-control">
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-send"></i>&nbsp;{{Lang::get('laravel-login::labels.send')}}</button>
        <a href="{{route('authenticate')}}" class="right"><i class="fa fa-angle-double-left"></i>&nbsp;{{Lang::get('laravel-login::labels.login')}}</a>
    </form>
@stop