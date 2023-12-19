@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{!! asset('assets/admin/css/jquery.datetimepicker.css') !!}"/>
@stop
@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">{{ $pageTitle }} <small></small></h3>
        {{ Breadcrumbs::render('admin.media-files.edit', $data) }}
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">

        @include('admin.partials.errors')

        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i> {{ $pageTitle }}
                </div>
            </div>

            <div class="portlet-body">

                <h4>&nbsp;</h4>

                <form method="POST" action="{{ route('admin.media-files.update', $data->id) }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="alt_text" class="col-md-2 control-label">Alternate Name *</label>
                        <div class="col-md-4">
                            <input type="text" name="alt_text" maxlength="190" value="{{ old('alt_name', $data->alt_text) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file" class="col-md-2 control-label">Filename *</label>
                        <div class="col-md-4">
                            <input type="file" name="file" class="form-control" maxlength="128" />
                            <input type="hidden" name="previous_image" value="{!! $data->filename !!}" />
                        </div>
                        <img height="50" width="150" src="{!! asset(uploadsDir().$data->filename) !!}" />
                    </div>
                    <div class="form-group">
                        <label for="caption" class="col-md-2 control-label">Caption *</label>
                        <div class="col-md-4">
                            <input type="text" name="caption" maxlength="190" value="{{ old('caption', $data->caption) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <input type="submit" class="btn blue" id="save" value="Save">
                            <input type="button" class="btn black" name="cancel" id="cancel" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<!-- END PAGE CONTENT-->
@stop

@section('footer-js')
<script type="text/javascript" src="{!! URL::to('assets/admin/plugins/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! URL::to('assets/admin/scripts/core/app.js') !!}"></script>
<script src="{!! asset('assets/admin/scripts/custom/jquery.datetimepicker.full.js') !!}"></script>

<script>
$('#start_time').datetimepicker({
    minDate:0
});

$('#end_time').datetimepicker({
    onShow:function( ct ){
        this.setOptions({
            minDate:jQuery('#start_time').val()?jQuery('#start_time').val():false
        })
    }
});

jQuery(document).ready(function() {
    // initiate layout and plugins
    App.init();
    Admin.init();
    $('#cancel').click(function() {
        window.location.href = "{!! URL::route('admin.media-files.index') !!}";
    });
});
</script>
@stop
