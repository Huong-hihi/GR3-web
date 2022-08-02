<div class="header">
    <div class="nav fluid">
        <a href="{{ route('home') }}" class="logo">
            <i style="margin-right: 10px;" class='bx bx-movie-play bx-tada main-color'></i>Mu<span class="main-color">sic</span>x
        </a>
        <form action="{{ route('home.search') }}" class="search-box">
            <input type="text" name="q" placeholder="Search Your Music ....." class="nav-search" value="{{ $search['q'] ?? '' }}">
            <button type="password">
                <i class='bx bx-search-alt'></i>
            </button>
        </form>
        <div class="nav-sign">
            @if(!$user)
                <a href="{{ route('login') }}" class="btn btn-hover">
                    <span>Sign in</span>
                </a>
            @elseif($user->role == \App\Http\Models\User::ROLE_ADMIN)
                <a href="{{ route('admin.user.index') }}" class="btn btn-hover">
                    <span>{{ $user->name }}</span>
                </a>
            @else
                <a href="{{ route('client.profile.index') }}" class="btn btn-hover">
                    <span>{{ $user->name }}</span>
                </a>
            @endif

        </div>
        <div class="menu-toggle">
            <ion-icon name="menu-outline" class="open"></ion-icon>
            <ion-icon name="close-outline" class="close"></ion-icon>
        </div>
    </div>
</div>

<div class="nav-container">
    <div class="nav fluid">
        <?php
        $userNav = \Illuminate\Support\Facades\Auth::user();
        ?>
        <ul class="nav-menu">
            <li class="nav-item active">
                <a href="{{ route('home') }}">
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="home-outline"></ion-icon>--}}
{{--                </span>--}}
                    Home
                </a>
            </li>
            <li class="nav-item active">
                <a href="{{ $userNav ? route('client.album.my-album') : route('login') }}">
                    {{--                <span class="nav-icon">--}}
                    {{--                    <ion-icon name="home-outline"></ion-icon>--}}
                    {{--                </span>--}}
                    My Album
                </a>
            </li>
            <li class="nav-item active">
                <a href="{{ $userNav ? route('client.follow.my-follow') : route('login') }}">
                    {{--                <span class="nav-icon">--}}
                    {{--                    <ion-icon name="home-outline"></ion-icon>--}}
                    {{--                </span>--}}
                    Follow
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home') . '#trending' }}">
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="film-outline"></ion-icon>--}}
{{--                </span>--}}
                    Trending
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home') . '#new-song' }}">
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="star-outline"></ion-icon>--}}
{{--                </span>--}}
                    New song
                </a>
            </li>
            <li class="nav-item" style="display: none">
                <a href="{{ route('home') . '#singer' }}">
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="mic-circle-outline"></ion-icon>--}}
{{--                </span>--}}
                    Singer
                </a>
            </li>
            {{--        @if($userNav)--}}
            {{--        <li class="nav-item">--}}
            {{--            <a href="{{ route('client.profile.index') }}">--}}
            {{--                    <span class="nav-icon">--}}
            {{--                        <ion-icon name="person-outline"></ion-icon>--}}
            {{--                    </span>--}}
            {{--                Account--}}
            {{--            </a>--}}
            {{--        </li>--}}
            <li class="nav-item">
                <a href="#">
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="help-circle-outline"></ion-icon>--}}
{{--                </span>--}}
                    About
                </a>
            </li>

</ul>
    </div>
</div>

