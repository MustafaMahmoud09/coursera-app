@include('layouts.fetch-error')

<header class="header">

    <section class="flex">

        <a href="{{ route('admin.dashboard') }}" class="logo">Admin</a>

        <form action="{{ route('instructor.playlist.search') }}" method="get" class="search-form">
            @csrf
            <input type="text" name="search" placeholder="search here..." required maxlength="100">
            <button type="submit" class="fas fa-search"></button>
        </form>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
        </div>

        <div class="profile">

            <img src="{{ asset('storage/' . auth()->guard(getInstructorGuard())->user()->image_path) }}" alt="">
            <h3>{{ auth()->guard(getInstructorGuard())->user()->name }}</h3>
            <span>{{ auth()->guard(getInstructorGuard())->user()->profession->profession }}</span>
            <a href="{{ route('instructor.profile') }}" class="btn">view profile</a>
            <a href="{{ route('instructor.logout') }}" onclick="return confirm('logout from this website?');"
                class="delete-btn">logout</a>

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

        <img src="{{ asset('storage/' . auth()->guard(getInstructorGuard())->user()->image_path) }}" alt="">
        <h3>{{ auth()->guard(getInstructorGuard())->user()->name }}</h3>
        <span>{{ auth()->guard(getInstructorGuard())->user()->profession->profession }}</span>
        <a href="{{ route('instructor.profile') }}" class="btn">view profile</a>


    </div>

    <nav class="navbar">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="{{ route('instructor.playlists.view') }}"><i
                class="fa-solid fa-bars-staggered"></i><span>Playlists</span></a>
        <a href="{{ route('instructor.playlist.contents.view') }}"><i
                class="fas fa-graduation-cap"></i><span>Contents</span></a>
        <a href="{{ route('instructor.playlist.content.comments.view') }}"><i
                class="fas fa-comment"></i><span>Comments</span></a>
        <a href="{{ route('instructor.logout') }}" onclick="return confirm('logout from this website?');"><i
                class="fas fa-right-from-bracket"></i><span>Logout</span></a>
    </nav>

</div>
