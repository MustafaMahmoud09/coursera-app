@include('layouts.fetch-error')

<!---->
<header class="header">

    <section class="flex">

        <a href="{{ route('home') }}" class="logo">React</a>

        <form action="{{ route('student.playlists.search') }}" method="get" class="search-form">
            @csrf
            <input type="text" name="search" placeholder="search courses..." required maxlength="100">
            <button type="submit" class="fas fa-search"></button>
        </form>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
        </div>

        <!--check user is auth now or no-->
        <div class="profile">
            @if (isStudentAuth())
                <img src="{{ asset('storage/' . auth()->guard(getStudentGaurd())->user()->image_path) }}"
                    alt="">
                <h3>
                    {{ auth()->guard(getStudentGaurd())->user()->name }}
                </h3>
                <span>student</span>
                <a href="{{ route('student.profile.view') }}" class="btn">view profile</a>
                <a href="{{ route('user.logout') }}" onclick="return confirm('logout from this website?');"
                    class="delete-btn">logout</a>
            @else
                <h3>please login or register</h3>
                <div class="flex-btn">
                    <a href="{{ route('student.login') }}" class="option-btn">login</a>
                    <a href="{{ route('student.register') }}" class="option-btn">register</a>
                </div>
            @endif

        </div>

    </section>

</header>

<!-- header section ends -->

<!-- side bar section starts  -->

<div class="side-bar">

    <div class="close-side-bar">
        <i class="fas fa-times"></i>
    </div>

    <div class="profile">

        @if (isStudentAuth())
            <img src="{{ asset('storage/' . auth()->guard(getStudentGaurd())->user()->image_path) }}" alt="">
            <h3> {{ auth()->guard(getStudentGaurd())->user()->name }}</h3>
            <span>student</span>
            <a href="{{ route('student.profile.view') }}" class="btn">view profile</a>
        @else
            <h3>please login or register</h3>
            <div class="flex-btn" style="padding-top: .5rem;">
                <a href="{{ route('student.login') }}" class="option-btn">login</a>
                <a href="{{ route('student.register') }}" class="option-btn">register</a>
            </div>
        @endif

    </div>

    <nav class="navbar">
        <a href="{{ route('home') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
        <a href="{{ route('student.about.view') }}"><i class="fas fa-question"></i><span>About us</span></a>
        <a href="{{ route('student.playlists.all.view') }}"><i
                class="fas fa-graduation-cap"></i><span>Courses</span></a>
        <a href="{{ route('student.teachers.all.view') }}"><i
                class="fas fa-chalkboard-user"></i><span>Teachers</span></a>
        <a href="{{ route('student.contacts.view') }}"><i class="fas fa-headset"></i><span>Contact us</span></a>
    </nav>

</div>
