<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('assets/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            Welcome !
                        </h5>
                    </div>

                    <!-- item-->
                {{--                    <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
                {{--                        <i class="fe-user"></i>--}}
                {{--                        <span>My Account</span>--}}
                {{--                    </a>--}}

                <!-- item-->
                {{--                    <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
                {{--                        <i class="fe-settings"></i>--}}
                {{--                        <span>Settings</span>--}}
                {{--                    </a>--}}

                <!-- item-->
                    {{--                    <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
                    {{--                        <i class="fe-lock"></i>--}}
                    {{--                        <span>Lock Screen</span>--}}
                    {{--                    </a>--}}

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    {{--                    <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
                    {{--                        <i class="fe-log-out"></i>--}}
                    {{--                        <span>Logout</span>--}}
                    {{--                    </a>--}}

                    <a class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fe-log-out"></i>
                        <span>{{ __('Logout') }}</span>

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo text-center">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo-dark.png')}}" alt="" height="26">
                    <!-- <span class="logo-lg-text-dark">Upvex</span> -->
                </span>
                <span class="logo-sm">
                    <!-- <span class="logo-sm-text-dark">X</span> -->
                    <img src="{{ asset('assets/images/logo-sm.png')}}" alt="" height="28">
                </span>
            </a>
        </div>


        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
