{{-- Created by anderson.mota on 12/11/2014. --}}
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{$seoTitle}}</title>
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
            <div class="row">
                <div class="col-lg-4 col-centered">
                    @include('laravel-login::partials.messages')
                    @yield('laravel-login::content')
                </div>
            </div>
        </div>

        <script src="{{asset("packages/lqdi/laravel-login/assets/components/jquery/dist/jquery.min.js")}}"></script>
        <script src="{{asset("packages/lqdi/laravel-login/assets/components/bootstrap-sass-twbs/assets/javascripts/bootstrap.js")}}"></script>
    </body>
</html>