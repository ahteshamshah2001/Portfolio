@extends('admin.layouts.app')

@section('css')
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="{!! URL::to('assets/admin/plugins/select2/select2.css') !!}"/>
<link rel="stylesheet" type="text/css" href="{!! URL::to('assets/admin/plugins/select2/select2-metronic.css') !!}"/>
<link rel="stylesheet" href="{!! URL::to('assets/admin/plugins/data-tables/DT_bootstrap.css') !!}"/>
<link href="{!! URL::to('assets/admin/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css') !!}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
@stop

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">{{ $pageTitle }} <small></small></h3>
        {{ Breadcrumbs::render('admin.site-settings.index') }}
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
                    <i class="fa fa-cog fa-lg"></i> {{ $pageTitle }}
                </div>
            </div>
            <div class="portlet-body">

                <h4>&nbsp;</h4>

                <form method="POST" action="{{ route('admin.site-settings.update', $records->id) }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="site_title" class="col-md-2 control-label">Site Title *</label>
                        <div class="col-md-4">
                            <input type="text" name="site_title" maxlength="190" value="{{ old('site_title', $records->site_title) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_email" class="col-md-2 control-label">Contact Email *</label>
                        <div class="col-md-4">
                            <input type="text" name="contact_email" maxlength="190" value="{{ old('contact_email', $records->contact_email) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_phone" class="col-md-2 control-label">Contact Phone</label>
                        <div class="col-md-4">
                            <input type="text" name="contact_phone" maxlength="190" value="{{ old('contact_phone', $records->contact_phone) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-4">
                            <input type="text" name="address" maxlength="190" value="{{ old('address', $records->address) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebook" class="col-md-2 control-label">FaceBook URL</label>
                        <div class="col-md-4">
                            <input type="text" name="facebook" maxlength="190" value="{{ old('facebook', $records->facebook) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitter" class="col-md-2 control-label">Twitter URL</label>
                        <div class="col-md-4">
                            <input type="text" name="twitter" maxlength="190" value="{{ old('twitter', $records->twitter) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pinterest" class="col-md-2 control-label">Pinterest URL</label>
                        <div class="col-md-4">
                            <input type="text" name="pinterest" maxlength="190" value="{{ old('pinterest', $records->pinterest) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="footer_scripts" class="col-md-2 control-label">Footer Script</label>
                        <div class="col-md-4">
                            <textarea name="footer_scripts" maxlength="65000" class="form-control" rows="3">{{ old('footer_scripts', $records->footer_scripts) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="footer_sentence" class="col-md-2 control-label">Footer Sentence *</label>
                        <div class="col-md-4">
                            <textarea name="footer_sentence" maxlength="65000" class="form-control" rows="3">{{ old('footer_sentence', $records->footer_sentence) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="copyright" class="col-md-2 control-label">Copyright Line</label>
                        <div class="col-md-4">
                            <textarea name="copyright" maxlength="65000" class="form-control" rows="3">{{ old('copyright', $records->copyright) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="logo" class="col-md-2 control-label">Logo </label>
                        <div class="col-md-4">
                            @if ($records->logo != '' && file_exists(uploadsDir() . $records->logo))
                                <img src="{!! uploadsUrl($records->logo) !!}" alt="" title="Logo" class="img-responsive" /><br>
                            @endif
                            <input type="file" name="logo" class="form-control" />
                            <input type="hidden" name="previous_logo" value="{{ $records->logo }}" />
                            <small><em>
                                <strong>Recommended width:</strong> up to 150 pixels<br />
                                <strong>Recommended height:</strong> 60-80 pixels
                            </em></small>
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="{!! URL::to('assets/admin/plugins/select2/select2.min.js') !!}"></script>
<script type="text/javascript" src="{!! URL::to('assets/admin/plugins/data-tables/jquery.dataTables.js') !!}"></script>
<script type="text/javascript" src="{!! URL::to('assets/admin/plugins/data-tables/DT_bootstrap.js') !!}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{!! URL::to('assets/admin/scripts/core/app.js') !!}"></script>
<script src="{!! URL::to('assets/admin/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') !!}" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
   // initiate layout and plugins
   App.init();
   Admin.init();

    $('#current_active_term').select2({
        placeholder: "Select Term",
        allowClear: true
    });

   $('#cancel').click(function() {
        window.location.href = '{!! URL::route('admin.dashboard.index') !!}';
   });
});
</script>
@stop
