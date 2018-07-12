<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="icon" type="image/png" href="../../public/assets/rgm_icon.png">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title>RGM</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('/css/slideimages.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/introText.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height" id="slider">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="load">

                </div>
                <div class="principal">
                    <div class="title m-b-md" id="title">
                        RGM
                    </div>

                    <div class="title m-b-md" id="subtitle">
                        Ronnie Gardiner Method
                    </div>

                    <div class="links">
                        <a href="http://www.ronniegardinermethod.com/">Visit our website</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="welcome-section content-hidden">
            <div class="content-wrap">
                <ul class="fly-in-text">
                    <li>R</li>
                    <li>G</li>
                    <li>M</li>
                </ul>
                <ul class="fly-in-text-2">
                    <li>C</li>
                    <li>o</li>
                    <li>m</li>
                    <li>m</li>
                    <li>u&nbsp;&nbsp;</li>
                    <li>n</li>
                    <li>i</li>
                    <li>t</li>
                    <li>y</li>
                </ul>
                <a href="#" class="enter-button">Enter</a>
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
                var welcomeSection = $('.welcome-section'),
                    enterButton = welcomeSection.find('.enter-button');

                setTimeout(function() {
                    welcomeSection.removeClass('content-hidden');
                }, 800);

                enterButton.on('click', function(e){
                    e.preventDefault();
                    welcomeSection.addClass('content-hidden').fadeOut();
                });
            });
        </script>
    </body>
</html>
