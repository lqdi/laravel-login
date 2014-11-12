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

        <link rel="stylesheet" href="{{asset("assets/css/main.min.css")}}">
        <script src="{{asset("components/modernizr/modernizr.js")}}"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
            <div class="row">
                <div class="large-6 large-centered columns">
                    @include('partials.messages')
                </div>
            </div>
            @yield('content')
        </div>

        <script src="{{asset("assets/js/main.min.js")}}"></script>
    </body>
</html>