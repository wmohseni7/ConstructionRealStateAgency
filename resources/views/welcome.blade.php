<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('assets/images/construction.png') }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="container col-lg-9 justify-content-center">
        <div class="">
           
            <nav class="navbar navbar-expand rounded-lg bg-light shadow-sm p-2 col-lg-12 col-xl-12 col-md-12 col-sm-12" style="font-family:sans-serif">
                <a class="navbar-brand mb-2" style="font-size: 20pt"><img src="{{ asset('assets/images/construction.png') }}" width="40px" height="40px" alt=""><span class="align-middle " style="color: #6756be"><strong> .ConstSYS </strong></span></a>
                <ul class="nav ms-auto">
                    <li class="m-2"><a href="" style="text-decoration: none" class="text-secondary"><h6>Home</h6></a></li>
                    <li class="m-2"><a href="" style="text-decoration: none" class="text-secondary"><h6>Projects</h6></a></li>
                    <li class="m-2"><a href="" style="text-decoration: none" class="text-secondary"><h6>Features</h6></a></li>
                    <li class="m-2"><a href="" style="text-decoration: none" class="text-secondary"><h6>Pricing</h6></a></li>
                    <li class="m-2"><a href="" style="text-decoration: none" class="text-secondary"><h6>Review</h6></a></li>
                    <li>
                            @if (Route::has('login'))
                            <div class="">
                                @auth
                                    <a href="{{ url('/dashboard') }}"><button class="btn btn-sm mb-2" id="btn1" style=".btn{ background-color:white; }background-color: #6756be"> Dashboard</button></a>
                                @else
                                    <a href="{{ route('login') }}"><button class="btn btn-sm mb-2" id="btn2"> Log in</button></a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"><button class="btn btn-sm mb-2" id="btn3" style=".btn{ background-color:white; }background-color: #6756be"> Register</button></a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </li>    
                </ul>
            </nav>
        </div>
        <div class="text-center shadow-sm p-5">
           <img src="{{ asset('assets/images/gallery/4025163.jpg') }}" class="col-lg-12" style="width:66%" alt="">
           {{-- <button class="btn p-3 text-white" style="margin-top:39%; background-color:#6756be"><h1>Explore!</h1></button> --}}
           <div class="container bg-white col-lg-12">
                <ul class="nav opacity-50">
                    <li class="col-lg-3"><img src="{{ asset('assets/images/Bluelounge_Logo_Grayscale.png') }}" width="100%" alt=""></li>
                    <li class="col-lg-3 mt-5"><img src="{{ asset('assets/images/havis_logo_grayscale_positive_png_5-09.png') }}" width="100%" alt=""></li>
                    <li class="col-lg-3 mt-5"><img src="{{ asset('assets/images/IREX_Logo_Grey-H.jpeg') }}" width="100%" alt=""></li>
                    <li class="col-lg-3 mt-5"><img src="{{ asset('assets/images/svm-client-logo_healthcare-grayscale-_healtcare-snapmd-logo.png') }}" width="100%" alt=""></li>
                </ul>
           </div>
        </div>
    </body>
</html>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
