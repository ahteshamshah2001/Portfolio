<!DOCTYPE html>
<!-- <a href="index.html" id="" title="index">index</a>
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 2.0.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="ISO-8859-1"/>
    <title>{{ $pageTitle }} | Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{ asset('assets/admin/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    @yield('css')
    <!-- BEGIN THEME STYLES -->
    <link href="{{ asset('assets/admin/css/style-metronic.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/style-responsive.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/pages/tasks.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/themes/default.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{ asset('assets/admin/css/print.css') }}" rel="stylesheet" type="text/css" media="print"/>
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    {{--<link rel="shortcut icon" href="{{ asset('assets/admin/favicon.png') }}"/>--}}
    @if (isset($siteSettings->logo) && adminHasAssets($siteSettings->logo))
        <link rel="shortcut icon" href="{!! asset(uploadsDir().$siteSettings->logo) !!}" />
    @else
        <link rel="shortcut icon" href="{!! asset('assets/admin/logo.png') !!}" />
    @endif
    <style>
        .redoc-wrap {
            padding-left: 250px;
        }
        .ebXbwy {
            left: 0 !important;
            position: fixed !important;
        }
        .iAMmDn {
            width: 100%;
        }
    </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-fixed-top">
        @include('admin.layouts.partials.header')
    </div>
    <!-- END HEADER -->

    <div class="clearfix"></div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
                <!-- BEGIN SIDEBAR MENU -->
                {{ Menu::admin(auth()->user()) }}
                <!-- END SIDEBAR MENU -->
                <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <!-- END SIDEBAR -->

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Delete Record</h4>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this record?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn default" data-dismiss="modal">No</button>
                                <button type="button" class="btn blue" id="deleteButton" data-dismiss="modal">Yes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                @yield('content')
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
             {!! \Carbon\Carbon::now()->format('Y') !!} &copy; Copyright by vServices.
        </div>
        <div class="footer-tools">
            <span class="go-top">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/admin/plugins/respond.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/excanvas.min.js') }}"></script>
    <![endif]-->
    <script src="{{ asset('assets/admin/plugins/jquery-1.10.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/scripts/custom/admin.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    @yield('footer-js')
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
