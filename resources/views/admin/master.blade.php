@extends('app')
@section('body-attribute', 'cz-shortcut-listen="true"')
@section('master')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('admin.layouts.nav-bar')
        <div class="layout-page">
            <div class="content-wrapper">
                @yield('content')
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
@endsection
