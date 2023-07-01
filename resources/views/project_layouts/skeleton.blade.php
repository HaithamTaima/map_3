<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"> </script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        @yield('css')

        <style>
            .sidenav{
                height: 100%;
                width: 250px;
                position: fixed;
                background-color: rgb(56, 56, 56);
                padding-top:30px ;
                padding-left: 0px;
            }
            .header{
                height: 70px;
                width: 100%;
                position: fixed;
                background-color: rgb(131, 105, 105);
            }
            hr.dotted{
                border-top: 2px dotted #bbb;
                padding: 20px 3px 3px 20px;
            }
            label{
                padding-top: 15px;
            }
            .sidenav a{
                Padding: 3px 12px 12px 5px;
                text-decoration: none;
                font-size: 16px;
                display: block;
                color: #ffffff;
                padding-left: 20px;

            }
            .sidenav a:hover{
                background: rgba(102, 106, 110, 0.5);
            }
            .page_body{
                padding-left: 260px;
                padding-top: 80px;
            }

        </style>
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    </head>
    <body  >
        <!-----HEADER------>
                <div class="header">
                    @include('project_layouts.header')
                </div>

        <!--------SIDE NAVIGATION-------->

            <div class="sidenav">
                @include('project_layouts.side_menu')
            </div>


        <!-----------BODY------------>

        <div class="page_body" >
            @yield('page_content')
        </div>

        <!----------FOOTER--------------->


@stack('javascript')
    </body>
</html>
