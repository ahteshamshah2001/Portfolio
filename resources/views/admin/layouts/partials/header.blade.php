<!-- BEGIN TOP NAVIGATION BAR -->

<div class="header-inner">
    <!-- BEGIN LOGO -->
    <a class="navbar-brand" href="{{ route('admin.dashboard.index') }}">

        @if (isset($siteSettings->logo) && adminHasAssets($siteSettings->logo))
            <img src="{!! asset(uploadsDir().$siteSettings->logo) !!}" alt="Web Builder" class="img-responsive" />
        @else
            <img src="{!! asset('assets/admin/logo.png') !!}" alt="Web Builder" class="img-responsive" style="height: 47px !important;
    margin-top: -11px;" />
        @endif

    </a>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <img src="{{ asset('assets/admin/img/menu-toggler.png') }}" alt=""/>
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <ul class="nav navbar-nav pull-right">
        <li class="dropdown" id="header_inbox_bar">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="fa fa-envelope"></i>
{{--                <span class="badge">--}}
{{--						 5--}}
{{--                </span>--}}
            </a>
        </li>
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <li class="dropdown user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img alt="admin avatar" width="29px" height="29px" src="{{ asset('assets/admin/img/avatar.png') }}"/>
                <span class="username">
                        {{ Auth::user()->fullName() }}
                    </span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    {{--<a href="{{ route('backend/users/'.Auth::user()->id.'/edit') }}">--}}
                    <a href="{{ route('admin.administrators.show', [Auth::user()->id]) }}">
                        <i class="fa fa-user"></i> My Profile
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('admin.users.change-password') }}">
                        <i class="fa fa-lock"></i> Change Password
                    </a>
                </li>
                <li>
                    <a href="javascript:;" id="trigger_fullscreen">
                        <i class="fa fa-arrows"></i> Full Screen
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.auth.logout') }}" id="header-logout-link">
                        <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
    </ul>
    <!-- END TOP NAVIGATION MENU -->
</div>
<!-- END TOP NAVIGATION BAR -->
