<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-gray-900">
        @inertia
        <div class="bg-gray-800">
        <div class="text-white text-center">

            <div class="">
                <p></p>
                <br>
                <p class=""> Luaskan ilmu, luaskan manfaat <br>
                    [ ] dengan  <span class="animate__animated animate__fadeIn animate__infinite text-red hvr-grow"> ❤
                    </span>
                    <!-- <q-spinner-hearts class="animated 2s infinite fadeIn" color="red" size="2.5em" /> -->
                    di Palu</p>
            </div>

            <div>
                ©2021 — <a href="https://github.com/imamsatya"> <img class="animate__animated animate__fadeIn animate__infinite text-red hvr-grow2" src="{{'images/dino.svg'}}" width="30" height="30" alt=""> </a> Imam Satya Wedhatama 
                
            </div> <br>
        </div>
    </div>
        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv
    </body>
</html>
<style>
    .hvr-grow {
      display: inline-block;
      vertical-align: middle;
      -webkit-transform: perspective(1px) translateZ(0);
      transform: perspective(1px) translateZ(0);
      box-shadow: 0 0 1px rgba(0, 0, 0, 0);
      -webkit-transition-duration: 0.3s;
      transition-duration: 0.3s;
      -webkit-transition-property: transform;
      transition-property: transform;
    }
    .hvr-grow:hover, .hvr-grow:focus, .hvr-grow:active {
      -webkit-transform: scale(1.5);
      transform: scale(1.5);
    }

    .hvr-grow2 {
      display: inline-block;
      vertical-align: middle;
      -webkit-transform: perspective(1px) translateZ(0);
      transform: perspective(1px) translateZ(0);
      box-shadow: 0 0 1px rgba(0, 0, 0, 0);
      -webkit-transition-duration: 0.3s;
      transition-duration: 0.3s;
      -webkit-transition-property: transform;
      transition-property: transform;
    }
    .hvr-grow2:hover, .hvr-grow2:focus, .hvr-grow2:active {
      -webkit-transform: scale(1.5);
      transform: scale(1.5);
    }
</style>