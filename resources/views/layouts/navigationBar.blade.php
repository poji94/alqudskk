<!-- Navbar -->
<nav class="navbar navbar-toggleable-md bg-primary fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                AlQuds Travel KK
            </a>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg" filter-color="purple">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <p>Home</p>
                    </a>
                </li>
                @if (Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('itinerary.getSelection') }}">
                            <p>Plan on My Own</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('packagetour.getSelection') }}">
                            {{--<i class="now-ui-icons files_paper"></i>--}}
                            <p>Tour Packages</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">
                            {{--<i class="fa fa-twitter"></i>--}}
                            {{--<p class="hidden-lg-up">My Booking</p>--}}
                            <p>My Booking</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">
                            <p>Login</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">
                            <p>Register</p>
                        </a>
                    </li>
                @else
                    @if(Auth::user()->role_user_id == 1 || Auth::user()->role_user_id == 2)
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="itineraryDropDown">
                                Plan on My Own
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="itineraryDropDown">
                                <a class="dropdown-item" href="{{ route('itinerary.getSelection') }}">View Activities</a>
                                <a class="dropdown-item" href="{{ url('/itinerary') }}">Manage Activities</a>
                                <a class="dropdown-item" href="{{ url('/itinerary/create') }}">Add Activity</a>
                                <div class="dropdown-divider"></div>
                            </ul>
                        </li>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="packageTourDropDown">
                                Tour Packages
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="packageTourDropDown">
                                <a class="dropdown-item" href="{{ route('packagetour.getSelection') }}">View Tour Packages</a>
                                <a class="dropdown-item" href="{{ url('/packagetour') }}">Manage Tour Packages</a>
                                <a class="dropdown-item" href="{{ url('/packagetour/create') }}">Add Tour Package</a>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle " data-toggle="dropdown" id="reservationDropDown">
                                Booking
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="reservationDropDown">
                                <a class="dropdown-item" href="{{ url('/reservation') }}">Manage Booking</a>
                                <a class="dropdown-item" href="{{ url('/packagetour') }}">My Own Booking</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('reservation.cartItinerary')}}">Plan My Own Cart</a>
                                <a class="dropdown-item" href="{{route('reservation.cartPackageTour')}}">Tour Package Cart</a>
                            </ul>
                        </div>
                        @if(Auth::user()->role_user_id == 1)
                            <div class="nav dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="userDropDown">
                                    Users
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropDown">
                                    <a class="dropdown-item" href="{{url('/user')}}">View All Users</a>
                                    <a class="dropdown-item" href="{{url('/user/create')}}">Add User</a>
                                </ul>
                            </div>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('itinerary.getSelection') }}">
                                <p>Plan on My Own</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('packagetour.getSelection') }}">
                                <p>Tour Package</p>
                            </a>
                        </li>
                        <div class="nav dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="reservationDropDown">
                                My Booking
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="reservationDropdown">
                                <a class="dropdown-item" href="{{ url('/packagetour') }}">My Own Booking</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('reservation.cartItinerary')}}">Plan My Own Cart</a>
                                <a class="dropdown-item" href="{{route('reservation.cartPackageTour')}}">Tour Package Cart</a>
                            </ul>
                        </div>
                    @endif
                    <div class="nav dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="userAccountDropDown">
                            Hello, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userAccountDropdown">
                            <a class="dropdown-item" href="{{ route('user.edit', Auth::user()->id) }}">View My Profile</a>
                            <a class="dropdown-item" href="{{ url('/logout') }}">Log Out</a>
                        </ul>
                    </div>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

