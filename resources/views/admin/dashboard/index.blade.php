@extends('admin.layouts.app')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">{{ $pageTitle }} <small></small></h3>
        {{ Breadcrumbs::render('admin.dashboard.index') }}
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>

@if (Session::get('success'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    {!! Session::get('success') !!}
</div>
@endif
<!-- END PAGE HEADER-->

<!-- BEGIN DASHBOARD STATS -->
<div class="row">

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="fa fa-user"></i>
            </div>
            <div class="details">
                <div class="number">
                    {!! isset($adminsCount) ? $adminsCount : 0 !!}
                </div>
                <div class="desc">
                    Admin Users
                </div>
            </div>
            <a class="more" href="">
                See Admin Users <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-users"></i>
            </div>
            <div class="details">
                <div class="number">
                    {!! isset($usersCount) ? $usersCount : 0 !!}
                </div>
                <div class="desc">
                    Users
                </div>
            </div>
            <a class="more" href="{!! route('admin.users.index') !!}">
                See Users <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="fa fa-tags"></i>
            </div>
            <div class="details">
                <div class="number">
                    {!! isset($rolesCount) ? $rolesCount : 0 !!}
                </div>
                <div class="desc">
                    Roles
                </div>
            </div>
            <a class="more" href="">
                See Roles <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                     0
                </div>
                <div class="desc">
                    Reports
                </div>
            </div>
            <a class="more" href="">
                See Reports <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="dashboard-stat orange">
            <div class="visual">
                <i class="fa fa-files-o"></i>
            </div>
            <div class="details">
                <div class="number">
                     0
                </div>
                <div class="desc">
                    Programme
                </div>
            </div>
            <a class="more" href="">
                See Programme <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="fa fa-user"></i>
            </div>
            <div class="details">
                <div class="number">
                    {!! isset($adminsCount) ? $adminsCount : 0 !!}
                </div>
                <div class="desc">
                    Admin Users
                </div>
            </div>
            <a class="more" href="{{ route('admin.administrators.index') }}">
                See Admin Users <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class="fa fa-sign-out"></i>
            </div>
            <div class="details">
                <div class="number">
                </div>
                <div class="desc">
                    Logout
                </div>
            </div>
            <a class="more" href="{{ route('admin.auth.logout') }}">
                Logout <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
{{--<div class="row">--}}
{{--    <div class="col-lg-4 col-md-4 col-sm-4">--}}
{{--        <div class="dashboard-stat red">--}}
{{--            <div class="visual">--}}
{{--                <i class="fa fa-sign-out"></i>--}}
{{--            </div>--}}
{{--            <div class="details">--}}
{{--                <div class="number">--}}
{{--                </div>--}}
{{--                <div class="desc">--}}
{{--                    Logout--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <a class="more" href="{{ route('admin.auth.logout') }}">--}}
{{--                Logout <i class="m-icon-swapright m-icon-white"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="clearfix"></div>

<div class="row" style="display:none;">
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="portlet solid bordered light-grey">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bar-chart-o"></i>Administrators
                </div>
            </div>
            <div class="portlet-body">
                <div id="administrators_loading">
                    <img src="{!! URL::to('assets/admin/img/loading.gif') !!}" alt="loading"/>
                </div>
                <div id="administrators_content" class="display-none">
                    <div id="administrators" class="chart">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="portlet solid bordered light-grey">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bar-chart-o"></i>Music Creators
                </div>
            </div>
            <div class="portlet-body">
                <div id="music_creators_loading">
                    <img src="{!! URL::to('assets/admin/img/loading.gif') !!}" alt="loading"/>
                </div>
                <div id="music_creators_content" class="display-none">
                    <div id="music_creators" class="chart">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="portlet solid bordered light-grey">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bar-chart-o"></i>Music Listeners
                </div>
            </div>
            <div class="portlet-body">
                <div id="music_listeners_loading">
                    <img src="{!! URL::to('assets/admin/img/loading.gif') !!}" alt="loading"/>
                </div>
                <div id="music_listeners_content" class="display-none">
                    <div id="music_listeners" class="chart">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@stop

@section('footer-js')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('assets/admin/scripts/core/app.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
   App.init(); // initlayout and core plugins
   Admin.init();
});
</script>
@stop
