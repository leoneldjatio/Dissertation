<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UBa Dissertation</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background: url({{asset('imgs/ubascene.jpg')}}) no-repeat;
                background-size: cover;
            }

            .container {
                width: 90%;
                margin: 0 auto;
            }

            .jumbotron p {
                font-size: 1.5em;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 50px;
                top: 55px;
            }

            .title {
                font-size: 84px;
            }

            .links > a, .btn{
                color: #636b6f;
                padding: 10px 15px;
                background: steelblue;
                color: white;
                margin-left: 15px;
                border: none;
                border-radius: 4px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .btn:hover {
                box-shadow: 0 1px 3px rgba(0,0,0,0.3);
                opacity: 0.96;
                cursor: pointer;
            }

           .btn-danger, .links .btn-danger {
                background: orangered;
            }

           .btn-success, .links .btn-success {
               background: forestgreen;
           }

           .content .btn {
               padding: 18px 30px;
               margin-left: 0;
               margin-top: 30px;
           }

           .content {
               font-weight: bolder;
               background: rgba(0,0,0,0.8);
               box-shadow: 1px 3px 5px rgba(0,0,0,0.5);
               padding: 30px 50px;
           }

           .text-center {
               text-align: center;
           }

           .mb-0 {
               margin-bottom: 0;
           }
            .mt-0 {
                margin-top: 0;
            }

            .text-white {
                color: white;
            }
          #learn-more .title {
            font-weight: 400;
            margin-bottom: 30px;
          }

          #learn-more p {
            font-size: 1.2em;
            line-height: 1.5em;
          }
        
        .logo {
            position: absolute;
            top: 10px;
            left: 50px;
            margin: 0;
            z-index: 1;
            display: flex;
            height: 100px;
            align-items: center;
        }

        .logo > img {
            max-width: 100%;
            height: auto;
            flex-basis: 100px;
        }
        
        .logo h2 {
            line-height: 15px;
            margin-left: 10px;
            font-weight: bold;
            color: steelblue;
        }

        .logo h2 > hr {
            opacity: 0.1;
            color: steelblue;
        }
        .slogan {
            font-size: .8em;
            margin-top: 0;
            font-weight: 450;
            font-family: "Nunito";
        }

    </style>
    </head>
    <body id="welcome-page">
        <div class="logo">
            <img src="{{asset('imgs/bam.png')}}" alt="UBa Logo">
            <h2 class="text-center">The University of Bamenda<br><hr><span class="slogan">The University of The Future</span></h2>
        </div>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" class="btn-success">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success py-3">Sign In</a>

                        <!--@if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-danger">Sign Up</a>
                        @endif -->
                    @endauth
                </div>
            @endif

            <div class="content text-center text-white">
                <div class="title mb-0">UBa Electronic Thesis and Dissertations (ETD)</div>
                <h2 class="lead mt-0 mb-0">A great amount of knowledge available for you like never before.</h2>
                <a href="{{ action('GalleryController@create'), '' }}"><button class="btn">Browse Projects</button></a>
                <a href="#learn-more" class="btn btn-danger">Learn More</a>
            </div>
        </div>
            <div id="learn-more" class="container full-height">
                <div class="jumbotron">
                    <h1 class="text-center title">About UBa ETD</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis in, impedit quae, a mollitia libero et accusantium quam beatae veniam dolorum rem dolorem. Ipsam rerum est consectetur, veritatis non totam.</p>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit quo unde dolorem aspernatur, animi, perspiciatis iure aperiam. Fugiat, provident, maiores illum, sunt minus at quisquam ullam modi, magnam ipsa ut.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui voluptate architecto suscipit. Voluptate ipsam dolor vel, ex, dolores maiores modi fugiat doloremque saepe reiciendis non? Fuga odio ipsa expedita accusamus.<b>Lorem ipsum dolor sit amet</b> consectetur adipisicing elit. Maiores quisquam eos possimus repellat beatae maxime aspernatur consectetur, distinctio reiciendis dolorem earum non dolor inventore, assumenda, itaque ab. Vel, <em>nostrum</em>, similique.</p>

                <ul>
                    <li>
                        <p>Item 1</p>
                    </li>
                    <li>
                        <p>Item 2</p>
                    </li>
                    <li>
                        <p>Item 3</p>
                    </li>
                    <li>
                        <p>Item 4</p>
                    </li>
                    <li>
                        <p>Item 5</p>
                    </li>
                </ul>
            </div>
    </body>
</html>
