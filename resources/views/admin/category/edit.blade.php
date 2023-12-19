@extends('admin.layouts.app')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">{{ $pageTitle }} <small></small></h3>
        {{ Breadcrumbs::render('admin.category.edit', $data) }}
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

                <form method="POST" action="{{ route('admin.category.update', $data->id) }}" class="form-horizontal" role="form">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="page_id" name="page_id" value="{{ $data->id }}"/>
                    <div class="form-group">
                        <label for="page_title" class="col-md-2 control-label">Page Title *</label>
                        <div class="col-md-4">
                            <input type="text" id="page_title" name="title" maxlength="190" value="{{ old('title', $data->title) }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="col-md-2 control-label">Slug *</label>
                        <div class="col-md-4">
                            <input id="slug" type="text" name="slug" maxlength="190" value="{{ old('slug', $data->slug) }}" class="form-control" {{ in_array($data->id, $restrictedPages) ? 'readonly="readonly"' : '' }} />
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
    var page_id = $("#page_id").val();
});

@if (!in_array($data->id, $restrictedPages))
    //Slug Generate Code
    $( "#page_title" ).on('blur', function() {
        var value = $( this ).val();
        $('#slug').val(slugify(value));
    }).keyup();

    //Slug Generate Code
    function slugify(text)
    {
      return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
    }
@endif
</script>
@stop
