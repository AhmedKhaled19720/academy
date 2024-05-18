<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/logo.jpeg') }}"
                        class="logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/logo.jpeg') }}"
                        class="dark-logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/logo.jpeg') }}"
                        class="logo-2" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/logo.jpeg') }}"
                        class="dark-logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>

        </div>
        <div class="main-header-right">

            <div class="nav nav-item  navbar-nav-right ml-auto">

                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href="">                                    <i class="fa fa-user text-white tx-20"></i>
                        <i class="fa fa-user tx-30"></i>
                    </a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user">
                                    <i class="fa fa-user text-white tx-20"></i>
                                </div>
                                <div class="mr-3 my-auto">
                                    <h6>{{Auth::User()->name}}</h6><span>{{Auth::User()->email}}</span>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
                        <a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="bx bx-log-out"></i>logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /main-header -->
