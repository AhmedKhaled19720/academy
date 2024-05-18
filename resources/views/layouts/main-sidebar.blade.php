<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">

    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo.jpeg') }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo.jpeg') }}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo.jpeg') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo.jpeg') }}" class="logo-icon dark-theme" alt="logo"></a>
    </div>


    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ URL::asset('assets/img/faces/6.jpg') }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::User()->name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::User()->email }}</span>
                </div>
            </div>
        </div>

        <ul class="side-menu">
            <li class="side-item side-item-category">dashboard</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'home')) }}"><i
                        class="side-menu__icon fa fa-home"></i><span class="side-menu__label">home</span></a>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><i
                        class="side-menu__icon fa fa-list-alt"></i><span class="side-menu__label">courses
                        categories</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'allcategories')) }}">all courses
                            categories</a>
                    <li><a class="slide-item" href={{ route('categories.create') }}>create new category</a>
                    </li>
            </li>
        </ul>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><i
                    class="side-menu__icon fa-solid fa-book-open"></i><span class="side-menu__label">courses</span><i
                    class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('courses') }}">all courses</a></li>
                <li><a class="slide-item" href="{{ route("courses.create") }}">create new course</a>
                </li>

            </ul>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><i
                    class="side-menu__icon fas fa-chalkboard-teacher"></i>
                <span class="side-menu__label">instructors</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item" href={{ route('instructors') }}>all instructors</a></li>
                <li><a class="slide-item" href="{{ url('/' . ($page = 'mail-compose')) }}">add new instructor</a>
                </li>

            </ul>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><i
                    class="side-menu__icon fa-solid fa-code-pull-request"></i><span
                    class="side-menu__label">requests</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ url('/' . ($page = 'allinstructors')) }}">instructors requests </a>
                </li>
                <li><a class="slide-item" href="{{ url('/' . ($page = 'contactUs')) }}">users requests</a></li>
            </ul>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                <i class="side-menu__icon fa fa-users"></i>
                <span class="side-menu__label">users</span>
                <i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ url('/' . ($page = 'allusers')) }}">all users </a></li>
                <li><a class="slide-item" href={{ route('users.create') }}>create users</a></li>
            </ul>
        

            </ul>
    </div>
</aside>
<!-- main-sidebar -->
