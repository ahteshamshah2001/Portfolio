@extends('admin.layouts.app')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">{{ $pageTitle }} <small></small></h3>
        {{ Breadcrumbs::render('admin.blog.create') }}
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
                    <i class="fa fa-create"></i> {{ $pageTitle }}
                </div>
            </div>

            <div class="portlet-body">

                <h4>&nbsp;</h4>
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.blog.store') }}" class="form-horizontal" role="form">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="page_title" class="col-md-2 control-label">Post By *</label>
                        <div class="col-md-4">
                            <input type="text" id="added_by" maxlength="190" name="added_by" value="{{ old('added_by') }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="page_title" class="col-md-2 control-label">Blog Title *</label>
                        <div class="col-md-4">
                            <input type="text" id="page_title" maxlength="190" name="title" value="{{ old('title') }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="col-md-2 control-label">Slug *</label>
                        <div class="col-md-4">
                            <input id="slug" type="text" name="slug" maxlength="190" value="{{ old('slug') }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-md-2 control-label">Content</label>
                        <div class="col-md-8">
                            <textarea name="description" class="form-control ckeditor" maxlength="65000" >{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="col-md-2 control-label">Slug *</label>
                        <div class="col-md-4">
                            <input id="slug" type="file" name="image"  class="form-control" />
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
        window.location.href = "{!! URL::route('admin.pages.index') !!}";
    });
});

$( "#page_title" ).blur(function() {
    var value = $( this ).val();
    $('#slug').val(slugify(value));
}).blur();

function slugify(text)
{
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}
</script>
@stop
