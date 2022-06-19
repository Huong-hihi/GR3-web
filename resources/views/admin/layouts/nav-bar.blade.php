<?php
$u = \Illuminate\Support\Facades\Auth::user();
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg
                    width="25"
                    viewBox="0 0 25 42"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g
                            id="Triangle"
                            transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                        >
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: uppercase;">{{ $u->name }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @if($u->role === \App\Http\Models\User::ROLE_ADMIN)
        <li class="menu-item">
            <a href="{{ route('admin.user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Tables">Users</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.singer.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-voice"></i>
                <div data-i18n="Tables">Singer</div>
            </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('admin.song.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-music"></i>
              <div data-i18n="Tables">Song</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('admin.category.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-category"></i>
              <div data-i18n="Tables">Category</div>
          </a>
        </li>
        @endif

        @if($u->role === \App\Http\Models\User::ROLE_USER)
            <li class="menu-item">
                <a href="{{ route('client.profile.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-user-circle'></i>
                    <div data-i18n="Tables">Profile</div>
                </a>
            </li>
        @endif

        <li class="menu-item">
            <a href="{{ route('logout') }}" class="menu-link" id="logout">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Tables">Logout</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</aside>
