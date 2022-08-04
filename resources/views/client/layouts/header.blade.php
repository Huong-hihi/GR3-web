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
                    <span>Đăng Nhập</span>
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
            <li class="nav-item2 active">
                <a href="{{ route('home') }}">
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="home-outline"></ion-icon>--}}
{{--                </span>--}}
                    Trang Chủ
                </a>
            </li>
            <li class="nav-item2 active nav-category category-hover">
                <span>
                    Thể loại
                </span>
                <ul class="nav-sub-category-wrapper">
                    @foreach($global['categories'] as $category)
                    <li class="category-item">
                        <a href="{{ route('home.category', ['id' => $category->id]) }}" class="category-link" onclick="function click (e) {e.preventDefault()}">
                            <div>
                                {{ $category->name }}
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item2 active">
                <a href="{{ $userNav ? route('client.album.my-album') : route('login') }}">
                    {{--                <span class="nav-icon">--}}
                    {{--                    <ion-icon name="home-outline"></ion-icon>--}}
                    {{--                </span>--}}
                    Album của tôi
                </a>
            </li>
            <li class="nav-item2 active">
                <a href="{{ $userNav ? route('client.follow.my-follow') : route('login') }}">
                    {{--                <span class="nav-icon">--}}
                    {{--                    <ion-icon name="home-outline"></ion-icon>--}}
                    {{--                </span>--}}
                    Ca sĩ theo dõi
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a href="{{ route('home') . '#trending' }}">--}}
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="film-outline"></ion-icon>--}}
{{--                </span>--}}
{{--                    Thịnh hành--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item2">
                <a href="{{ route('home') . '#new-song' }}">
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="star-outline"></ion-icon>--}}
{{--                </span>--}}
                    Bài hát mới
                </a>
            </li>
            <li class="nav-item2" style="display: none">
                <a href="{{ route('home') . '#singer' }}">
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="mic-circle-outline"></ion-icon>--}}
{{--                </span>--}}
                    Ca sĩ
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
            <li class="nav-item2">
                <a href="#">
{{--                <span class="nav-icon">--}}
{{--                    <ion-icon name="help-circle-outline"></ion-icon>--}}
{{--                </span>--}}
                    Thông tin
                </a>
            </li>

</ul>
    </div>
</div>

