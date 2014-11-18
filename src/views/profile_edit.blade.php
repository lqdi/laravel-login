{{-- Created by anderson.mota on 18/11/2014. --}}
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{Lang::get('laravel-login::labels.edit_profile')}}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->

        <link rel="stylesheet" href="{{asset("packages/lqdi/laravel-login/assets/css/main.css")}}">
        <script src="{{asset("packages/lqdi/laravel-login/components/modernizr/modernizr.js")}}"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
            <div class="col-sm-10 col-sm-offset-2">
                @include('laravel-login::partials.messages')
            </div>
            <form class="form-horizontal" role="form" method="post">
                <h2 class="text-center">{{Lang::get('laravel-login::labels.edit_profile')}}</h2>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">{{Lang::get("laravel-login::labels.name")}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="first_name" placeholder="{{Lang::get("laravel-login::labels.name")}}" value="{{$profile->first_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">{{Lang::get("laravel-login::labels.email")}}</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="{{Lang::get("laravel-login::labels.email")}}" value="{{$profile->email}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">{{Lang::get("laravel-login::labels.password")}}</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="{{Lang::get("laravel-login::labels.password")}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputConfirmPassword" class="col-sm-2 control-label">{{Lang::get("laravel-login::labels.confirm_password")}}</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputConfirmPassword" name="password_confirmation" placeholder="{{Lang::get("laravel-login::labels.confirm_password")}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{Lang::get("laravel-login::labels.save")}}</button>
                    </div>
                </div>
            </form>
        </div>

        <script src="{{asset("packages/lqdi/laravel-login/assets/components/jquery/dist/jquery.min.js")}}"></script>
        <script src="{{asset("packages/lqdi/laravel-login/assets/components/bootstrap-sass-twbs/assets/javascripts/bootstrap.js")}}"></script>
    </body>
</html>