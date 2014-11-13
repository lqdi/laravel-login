{{-- Created by anderson.mota on 12/11/2014. --}}
@extends('laravel-login::layout')
@section('laravel-login::content')
<div class="row">
    <div class="large-8 medium-centered columns">
        <form action="" method="post">
            <div class="row">
                <div class="medium-3 columns">
                    <label for="inputPassword" class="medium-text-right medium-inline">{{Lang::get('laravel-login::labels.new_password')}}:</label>
                </div>
                <div class="medium-9 columns">
                    <input type="password" id="inputPassword" name="password" />
                </div>
            </div>
            <div class="row">
                <div class="medium-3 columns">
                    <label for="inputConfirmPassword" class="medium-text-right medium-inline">{{Lang::get('laravel-login::labels.confirm_password')}}:</label>
                </div>
                <div class="medium-9 columns">
                    <input type="password" id="inputConfirmPassword" name="password_confirmation"/>
                </div>
            </div>
            <div class="row">
                <div class="medium-9 medium-offset-3 columns">
                    <button type="submit"><i class="fa fa-send"></i>&nbsp;{{Lang::get('laravel-login::labels.send')}}</button>
                    <a href="{{route('authenticate')}}" class="right"><i class="fa fa-angle-double-left"></i>&nbsp;{{Lang::get('laravel-login::labels.login')}}</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop