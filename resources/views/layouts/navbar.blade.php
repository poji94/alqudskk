<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{--<img src="preset/icon.png" alt="" style="width: 35px; height: 35px; display: inline"> AlQudsKK--}}
                AlQuds Travel KK
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/') }}">Home</a></li>
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('itinerary.getSelection') }}">Activity</a></li>
                    <li><a href="{{ route('packagetour.getSelection') }}">Tour Packages</a></li>
                    <li><a href="{{ url('/login') }}">Reservation</a></li>
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    @if(Auth::user()->role_user_id == 1 || Auth::user()->role_user_id == 2)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Activity<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('itinerary.getSelection') }}">View activities</a></li>
                                <li><a href="{{ url('/itinerary') }}">Manage activities</a></li>
                                <li><a href="{{ url('/itinerary/create') }}">Add activity</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Tour Package<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('packagetour.getSelection') }}">View Tour Packages</a></li>
                                <li><a href="{{ url('/packagetour') }}">Manage tour packages</a></li>
                                <li><a href="{{ url('/packagetour/create') }}">Add package tour</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Reservation<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/reservation') }}">Manage reservations</a></li>
                                <li><a href="{{ route('reservation.getUserReservation')}}">My reservations</a></li>
                                <li><a href="{{route('reservation.cartItinerary')}}">Activity Cart</a></li>
                                <li><a href="{{route('reservation.cartPackageTour')}}">Tour Package Cart</a></li>
                            </ul>
                        </li>
                        @if(Auth::user()->role_user_id == 1)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    User<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{url('/user')}}">View all users</a></li>
                                    <li><a href="{{url('/user/create')}}">Add User</a></li>
                                </ul>
                            </li>
                        @endif
                    @else
                        <li><a href="{{ route('itinerary.getSelection') }}">Activity</a></li>
                        <li><a href="{{ route('packagetour.getSelection') }}">Tour Packages</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Reservation<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('reservation.getUserReservation')}}">My reservations</a></li>
                                <li><a href="{{route('reservation.cartItinerary')}}">Activity Cart</a></li>
                                <li><a href="{{route('reservation.cartPackageTour')}}">Tour Package Cart</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('user.edit', Auth::user()->id) }}">View Profile</a></li>
                            <li><a href="{{ url('/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
