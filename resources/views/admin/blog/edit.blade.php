@extends('admin.layouts.app')

@section('content')
    <!-- BEGIN PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title">{{ $pageTitle }} <small></small></h3>
        {{ Breadcrumbs::render('admin.pages.edit', $data) }}
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

                    <form method="POST" action="{{ route('admin.blog.update', $data->id) }}" class="form-horizontal"
                          role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="media_file_id" class="col-md-2 control-label">Uploaded Image</label>
                            <div class="col-md-8" style="overflow-y:scroll; overflow-x:hidden; height:100px;">
                                <img height="50" width="150"
                                     src="{!! asset(uploadsDir().$data->image) !!}"/>
                            </div>
                        </div>

                        <input type="hidden" id="page_id" name="page_id" value="{{ $data->id }}"/>
                        <div class="form-group">
                            <label for="page_title" class="col-md-2 control-label">Post By *</label>
                            <div class="col-md-4">
                                <input type="text" id="added_by" maxlength="190" name="added_by"
                                       value="{{ old('added_by', $data->added_by) }}" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="page_title" class="col-md-2 control-label">Page Title *</label>
                            <div class="col-md-4">
                                <input type="text" id="page_title" name="title" maxlength="190"
                                       value="{{ old('title', $data->title) }}" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-md-2 control-label">Slug *</label>
                            <div class="col-md-4">
                                <input id="slug" type="text" name="slug" maxlength="190"
                                       value="{{ old('slug', $data->slug) }}" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-md-2 control-label">Upload Image *</label>
                            <div class="col-md-4">
                                <input type="file" name="image" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-md-2 control-label">Content</label>
                            <div class="col-md-8">
                                <textarea name="description" class="form-control ckeditor" maxlength="65000"
                                          rows="3">{{ old('description', $data->description) }}</textarea>
                            </div>
                        </div>
                        <div class="form-control">
                            <label for="content" class="col-md-2 control-label">Status</label>
                            <div class="col-md-8">
                                <select name="status" class="form-control">
                                    <option value="1" {{ $data->status == 1 ? "selected" : "" }}>Active</option>
                                    <option value="0" {{ $data->status == 0 ? "selected" : "" }}>DeActive</option>
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
        jQuery(document).ready(function () {
            // initiate layout and plugins
            App.init();
            Admin.init();
            $('#cancel').click(function () {
                window.location.href = "{!! URL::route('admin.pages.index') !!}";
            });
            var page_id = $("#page_id").val();
        });


        //Slug Generate Code
        $("#page_title").on('blur', function () {
            var value = $(this).val();
            $('#slug').val(slugify(value));
        }).keyup();

        //Slug Generate Code
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }
    </script>
@stop
