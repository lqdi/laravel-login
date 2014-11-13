{{-- Created by anderson.mota on 12/11/2014. --}}
@extends('layout')
@section('content')
    <div class="row">
        <div class="large-6 large-centered columns">
            <form action="" method="post">
                <div>
                    <label for="inputEmail">{{Lang::get('laravel-login::labels.email')}}:</label><input type="text" name="email" id="inputEmail"><small></small>
                </div>
                <button type="submit"><i class="fa fa-send"></i>&nbsp;{{Lang::get('laravel-login::labels.send')}}</button>
                <a href="{{route('authenticate')}}" class="right"><i class="fa fa-angle-double-left"></i>&nbsp;{{Lang::get('laravel-login::labels.login')}}</a>
            </form>
        </div>
    </div>
@stop