@extends('admin.layouts.app')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">{{ $pageTitle }} <small></small></h3>
        {{ Breadcrumbs::render('admin.administrators.create') }}
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
                    <i class="fa fa-plus"></i> {{ $pageTitle }}
                </div>
            </div>

            <div class="portlet-body">

                <h4>&nbsp;</h4>

                <form method="POST" action="{{ route('admin.administrators.store') }}" class="form-horizontal" role="form">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="first_name" class="col-md-2 control-label">First Name *</label>
                        <div class="col-md-4">
                            <input type="text" maxlength="32" name="first_name" value="{{ old('first_name') }}" class="form-control" />
                        </div>

                        <label for="last_name" class="col-md-2 control-label">Last Name *</label>
                        <div class="col-md-4">
                            <input type="text" maxlength="32" name="last_name" value="{{ old('last_name') }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-md-2 control-label">Phone *</label>
                        <div class="col-md-4">
                            <input type="text" name="phone" maxlength="24" value="{{ old('phone') }}" class="form-control" />
                        </div>

                        <label for="email" class="col-md-2 control-label">Email *</label>
                        <div class="col-md-4">
                            <input type="text" maxlength="128" name="email" value="{{ old('email') }}" class="form-control" />
                        </div>
                    </div>
                 
                    <div class="form-group">
                        <label for="last_name" class="col-md-2 control-label">Status *</label>
                        <div class="col-md-4">
                            <select class="form-control" name="is_active">
                                <option value=""> - Select - </option>
                                <option value="1" {{ old('is_active') == '1' ? 'selected="selected"' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected="selected"' : '' }}>Blocked</option>
                            </select>
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
<script>
jQuery(document).ready(function() {
   // initiate layout and plugins
   App.init();
   Admin.init();
   $('#cancel').click(function() {
        window.location.href = "{!! URL::route('admin.administrators.index') !!}";
   });
});
</script>
@stop
