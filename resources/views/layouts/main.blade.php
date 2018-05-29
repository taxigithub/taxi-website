<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>mr.Cab</title>
        <!-- Compiled and minified CSS -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css">

    </head>
    <body>
        <div class="navbar">
            <nav class="teal lighten-2" role="navigation">
                <div class="nav-wrapper container">
                   {{-- @if (URL::current() != url('/'))
                    <ul class="left hide-on-med-and-down">
                        <li><a href="{{ URL::previous() }}"> <i class="large material-icons">arrow_back</i></a></li>
                    </ul>
                    @endif --}}
                    <a id="logo-container" href="{{url('/')}}" class="brand-logo center"><img style="width: 8em" src="{{asset('storage/img/logo.png')}}" /></a>
                    
                    <ul class="right hide-on-med-and-down">
                        @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="{{action('ProfileController@Index')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hi, {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                        @endif
                    </ul>

                    <ul id="nav-mobile"  class="side-nav" >
                        @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="{{action('ProfileController@Index')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hi, {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                        @endif
                    </ul>
                    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
                </div>
            </nav>
        </div>


        @yield('content')

        @yield('footer')
        <!-- Compiled and minified JavaScript -->


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.js"></script>
        <script>
                                   $(".button-collapse").sideNav();
                                   $(document).ready(function () {
                                       $('.parallax').parallax();
                                   });

        </script>
    </body>
</html>
