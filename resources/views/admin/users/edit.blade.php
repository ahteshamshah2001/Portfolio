@extends('admin.layouts.app')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">{{ $pageTitle }} <small></small></h3>
        {{ Breadcrumbs::render('admin.users.edit', $data) }}
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

                <form method="POST" action="{{ route('admin.users.update', $data->id) }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name *</label>
                        <div class="col-md-4">
                            <input type="text" name="name" value="{{ old('name', $data->name) }}" class="form-control" />
                        </div>

                        <label for="email" class="col-md-2 control-label">Email *</label>
                        <div class="col-md-4">
                            <input type="text" readonly name="email" value="{{ old('email', $data->email) }}" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-md-2 control-label">Phone *</label>
                        <div class="col-md-4">
                            <input type="text" name="phone" value="{{ old('phone', $data->phone) }}" class="form-control" />
                        </div>

                        <label for="areas_of_expertise" class="col-md-2 control-label">Areas Of Expertise *</label>
                        <div class="col-md-4">
                            <select class="form-control" name="areas_of_expertise">
                                <option value=""> - Select Areas Of Expertise - </option>
                                @foreach($courses as $course)
                                <option value="{!! $course->id !!}"
                                  {{ old('areas_of_expertise', $data->course_id) ==  $course->id ? 'selected="selected"' : '' }}>{!! $course->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">House No</label>
                        <div class="col-md-4">
                            <input type="text" name="house_no" value="{{ old('house_no', $data->house_no) }}" class="form-control" />
                        </div>

                        <label for="building_no" class="col-md-2 control-label">Building No</label>
                        <div class="col-md-4">
                            <input type="text" name="building_no" value="{{ old('building_no', $data->building_no) }}" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="per_day_rate" class="col-md-2 control-label">Per Day Rate</label>
                        <div class="col-md-4">
                            <input type="text" name="per_day_rate" value="{{ old('per_day_rate', $data->per_day_rate) }}" class="form-control" />
                        </div>

                        <label for="per_hour_rate" class="col-md-2 control-label">Per Hour Rate</label>
                        <div class="col-md-4">
                            <input type="text" name="per_hour_rate" value="{{ old('per_hour_rate', $data->per_hour_rate) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-md-2 control-label">Role *</label>
                        <div class="col-md-4">
                            <select name="roles[]" class="form-control" multiple>
                                {{-- <option value=""> - Select - </option> --}}
                                @foreach($roles as $role)
                                    <option value="{!! $role->id !!}" {{ $data->roles->contains('id', $role->id)  ? 'selected="selected"' : '' }}> {!! $role->name !!} </option>
                                @endforeach
                            </select>
                            <div class="help-block">Multiple roles can be selected using Ctrl+Click</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file" class="col-md-2 control-label">Update Photo *</label>
                        <div class="col-md-4">
                            <input type="file" name="photo" class="form-control" maxlength="128" />
                            <input type="hidden" name="previous_image" value="{!! $data->photo !!}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="col-md-2 control-label">Status *</label>
                        <div class="col-md-4">
                            <select class="form-control" name="is_active">
                                <option value=""> - Select - </option>
                                <option value="1" {{ old('is_active', $data->is_active) == '1' ? 'selected="selected"' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $data->is_active) == '0' ? 'selected="selected"' : '' }}>Blocked</option>
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
        window.location.href = "{!! URL::route('admin.users.index') !!}";
   });


});
</script>
@stop
