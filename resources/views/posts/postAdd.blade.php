@extends('Ripple::layouts.app')
@section('page-content')
<div class="content">
    <form action=""  method="post" class="form-horizontal push-5-t" enctype="Multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" value="zzz" name="post-create">
        <input type="hidden" value="post" name="post-type">
        <input type="hidden" value="1" name="post-author">
        <div class="block block-themed">
            <div class="block-header bg-gray-darker">
                <ul class="block-options">
                    <li>
                        <button data-toggle="modal" data-target="#modal-popout" type="button"><i class="fa fa-gears text-primary" style="font-size: 18px"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">New Post</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" id="login1-username" name="post-title" placeholder="Post Title" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea name="post-content" class="ripple_text_editor" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea name="post-excerpt" class="form-control" id="" rows="4" placeholder="Excerpt"></textarea>
                            </div>
                        </div>
                        <!--<div id="editor" style="min-height: 400px;width: 100%;"></div>-->
                        <!--<textarea name="post-code" id="code-editor" cols="30" rows="10"></textarea>-->
                        <div class="block block-bordered">
                            <ul class="nav nav-tabs" data-toggle="tabs">
                                <li class="active">
                                    <a href="#btabs-post-categories"><i class="fa fa-folder-open"></i> Categories</a>
                                </li>
                                <li class="">
                                    <a href="#btabs-post-tags"><i class="fa fa-tags"></i> Tags</a>
                                </li>
                                <li class="pull-right">
                                    <a href="#btabs-post-settings" data-toggle="tooltip" title="" data-original-title="Settings"><i class="si si-settings"></i> Settings</a>
                                </li>
                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane fade fade-left active in" id="btabs-post-categories">
                                    <div class="row block-content-row">
                                        <div class="col-md-12">
                                            @foreach(Ripple::allCategories() as $category)
                                            <label for="category-{!! $category->id !!}" class="css-input btn checkbox-category btn-default css-checkbox css-checkbox-primary">
                                                <input id="category-{!! $category->id !!}" name="post-category[]" value="{!! $category->id !!}" type="checkbox">
                                                <span></span> 
                                                {!! $category->name !!}
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade fade-left" id="btabs-post-tags">
                                    <div class="row block-content-row">
                                        <div class="col-md-12">
                                            @foreach(Ripple::allTags() as $tag)
                                            <label for="tag-{!! $tag->id !!}" class="btn btn-default checkbox-tag css-input css-checkbox css-checkbox-info">
                                                <input id="tag-{!! $tag->id !!}" name="post-tag[]" value="{!! $tag->id !!}" type="checkbox">
                                                <span></span> 
                                                {!! $tag->name !!}
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade fade-left" id="btabs-post-settings">
                                    <h4 class="font-w300 push-15">Settings Tab</h4>
                                    <p>Content slides in to the left..</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3">
                        <div class="block block-themed block-bordered block-rounded" style="border-color: #999999;">
                            <div class="block-header bg-muted">
                                <h3 class="block-title">Publish</h3>
                            </div>
                            <div class="block-content" >
                                <p><i class="fa fa-flag"></i> Status: <b id="current-status">Draft</b> <a href="javascript:void(0);" class="pull-right"><i class="fa fa-pencil-square-o"></i></a></p>
                                <input type="hidden" value="draft" name="post-status" id="post-status">
                                <p><i class="fa fa-eye"></i> Visibility: <b id="current-status">Public</b> <a href="javascript:void(0);" class="pull-right"><i class="fa fa-pencil-square-o"></i></a></p>
                                <input type="hidden" value="public" name="post-visibility">
                                <p><i class="fa fa-comments"></i> Comments: <b id="current-status">Open</b> <a href="javascript:void(0);" class="pull-right"><i class="fa fa-pencil-square-o"></i></a></p>
                                <input type="hidden" value="open" name="post-comments">
                            </div>
                            <div class="block-content bg-gray-lighter">
                                <p class="text-center">
                                    <button class="btn btn-primary btn-rounded" type="submit">Save as Draft</button>
                                    <button class="btn btn-primary btn-rounded" type="submit" onclick="document.getElementById('post-status').value = 'published';">Publish</button>
                                </p>
                            </div>
                        </div>
                        <div class="block block-themed block-bordered block-rounded" style="border-color: #70B9EB;">
                            <div class="block-header bg-info">
                                <ul class="block-options">
                                    <li>
                                        <button data-toggle="modal" data-target="#modal-large" type="button"><i class="fa fa-photo" style="font-size: 18px"></i></button>
                                    </li>
                                </ul>
                                <h3 class="block-title">Featured Image</h3>
                            </div>
                            <div class="block-content text-center " style="min-height: 200px;max-height: 200px;">
                                <div class="clearfix" id="featured-image">
                                    <img width="200" height="200" class="img-responsive" src="{!! ripple_asset('/img/default/default.png') !!}" alt="">
                                </div>
                            </div>
                            <div class="block-content bg-gray-lighter text-center clearfix">
                                <p>
                                    <input type="file" class="image-preview" name="post-image" id="post-image" data-preview='featured-image' style="display:none;">
                                    <button class="btn btn-success btn-rounded" type="button" onclick="document.getElementById('post-image').click();">Change Image</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-popout" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-popout">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Post Options</h3>
                </div>
                <!--block-opt-refresh-->
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group clearfix" >
                                <div class="col-md-4 text-center option-group-publish">
                                    <label for="publish-option" class="css-input css-radio css-radio-success push-10-r">
                                        <input name="option-group" type="radio" id="publish-option">
                                        <span></span> 
                                        Publish
                                    </label>
                                </div>
                                <div class="col-md-4 text-center option-group-tag">
                                    <label for="tag-add" class="css-input css-radio css-radio-success push-10-r">
                                        <input name="option-group" type="radio" id="tag-add">
                                        <span></span> 
                                        Add Tag
                                    </label>
                                </div>
                                <div class="col-md-4 text-center option-group-category">
                                    <label for="category-add" class="css-input css-radio css-radio-success push-10-r">
                                        <input name="option-group" type="radio" id="category-add">
                                        <span></span> 
                                        Add Category
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content" id="group-publish-option" style="display:none;padding-top: 0px;">
                    <div class="block block-themed block-bordered">
                        <div class="block-header bg-success">
                            <h3 class="block-title">Post Publish Settings</h3>
                        </div>
                        <div class="block-content" style="padding-bottom:15px;">
                            <div class="cearfix form-group">
                                <label for=""><i class="fa fa-flag"></i> Status: </label>
                                <select name="" id="" class="form-control">
                                    <option value="">----- Post Status -----</option>
                                    <option value="published" selected="">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                            <div class="cearfix form-group">
                                <label for=""><i class="fa fa-eye"></i> Visibility: </label>
                                <select name="" id="" class="form-control">
                                    <option value="">----- Post Visibility -----</option>
                                    <option value="published" selected>Public</option>
                                    <option value="draft">Private</option>
                                    <option value="password">Password</option>
                                </select>
                            </div>
                            <div class="cearfix form-group">
                                <label for=""><i class="fa fa-comments"></i> Comments: </label>
                                <select name="" id="" class="form-control">
                                    <option value="">----- Post Comments -----</option>
                                    <option value="open" selected>Open</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center" style="padding-top:15px">
                                    <button class="btn btn-primary btn-rounded">Save Setting</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content" id="group-category-add" style="display:none;padding-top: 0px">
                    <div class="block block-themed block-bordered">
                        <div class="block-header bg-success">
                            <h3 class="block-title">New Category</h3>
                        </div>
                        <div class="block-content" style="padding-bottom:15px;">
                            <div class="cearfix form-group">
                                <input type="text" class="form-control" placeholder="Category Name">
                            </div>
                            <label for="">Select Parent</label>
                            <div class="cearfix form-group scrollable100" style="margin-bottom:10px;border:1px solid gainsboro; padding: 10px;">
                                @foreach($categories as $category)
                                @if($category->parent === 0)
                                <div class="col-md-12 remove-padding post-categories">
                                    <label for="category-parent-{!! $category->id !!}" class="css-input css-radio css-radio-success push-10-r">
                                        <input name="category-parent" type="radio" id="category-parent-{!! $category->id !!}">
                                        <span></span> 
                                        {!! $category->name !!}
                                    </label>
                                    @foreach($categories as $child)
                                    @if($child->parent === $category->id)
                                    <div class="col-md-12" style="padding: 0px 20px;">
                                        <label for="category-parent-{!! $child->id !!}" class="css-input css-radio css-radio-success push-10-r">
                                            <input name="category-parent" type="radio" id="category-parent-{!! $child->id !!}">
                                            <span></span> 
                                            {!! $child->name !!}
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center" style="padding-top:15px">
                                    <button class="btn btn-primary btn-rounded">Save Category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content" id="group-tag-add" style="display:none;padding-top: 0px;">
                    <div class="block block-themed block-bordered">
                        <div class="block-header bg-success">
                            <h3 class="block-title">New Tag</h3>
                        </div>
                        <div class="block-content" style="padding-bottom:15px;">
                            <div class="cearfix form-group">
                                <input type="text" class="form-control" placeholder="Tag Name">
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center" style="padding-top:15px">
                                    <button class="btn btn-primary btn-rounded">Save Tag</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-header bg-primary-dark"><h3 class="block-title">&nbsp;</h3></div>
        </div>
    </div>
</div>
@stop
@push('page-script') 
<link rel="stylesheet" href="{!! ripple_asset('/lib/css/select2/select2.min.css') !!}"/>
<script src="{!! ripple_asset('/lib/js/select2/select2.min.js') !!}" type="text/javascript" charset="utf-8"></script>
<script src="{!! ripple_asset('/lib/js/slimscroll/slimscroll.min.js') !!}" type="text/javascript" charset="utf-8"></script>
<script src="{!! ripple_asset('/lib/js/ace/ace.js') !!}" type="text/javascript" charset="utf-8"></script>
<script>
                                $(document).on('change', '#select-tag', function () {
                                    console.log($(this).val());
                                });
                                $('.scrollable200').slimScroll({
                                    height: '200px'
                                });
                                $('.scrollable100').slimScroll({
                                    height: '100px'
                                });
                                $(".select2_demo_3").select2({
                                    placeholder: "Select a state",
                                    allowClear: false
                                });
                                $(".multipleSelect").select2({
                                    placeholder: "Categories",
//            allowClear: true
                                });
                                var editor = ace.edit("editor");
                                editor.setTheme("ace/theme/twilight");
                                editor.session.setMode("ace/mode/php");
//    alert(editor.getValue());
                                editor.on('change', function () {
                                    document.getElementById('code-editor').value = editor.getValue();
                                });
                                /*
                                 var options_editor = ace.edit('options_editor');
                                 options_editor.getSession().setMode("ace/mode/json");
                                 
                                 var options_textarea = document.getElementById('options_textarea');
                                 options_editor.getSession().on('change', function() {
                                 options_textarea.value = options_editor.getValue();
                                 });
                                 
                                 
                                 var ace_editor_element = document.getElementsByClassName("ace_editor");
                                 
                                 // For each ace editor element on the page
                                 for(var i = 0; i < ace_editor_element.length; i++)
                                 {
                                 
                                 // Create an ace editor instance
                                 var ace_editor = ace.edit(ace_editor_element[i].id);
                                 
                                 // Get the corresponding text area associated with the ace editor
                                 var ace_editor_textarea = document.getElementById(ace_editor_element[i].id + '_textarea');
                                 
                                 if(ace_editor_element[i].getAttribute('data-theme')){
                                 ace_editor.setTheme("ace/theme/" + ace_editor_element[i].getAttribute('data-theme'));
                                 }
                                 
                                 if(ace_editor_element[i].getAttribute('data-language')){
                                 ace_editor.getSession().setMode("ace/mode/" + ace_editor_element[i].getAttribute('data-language'));
                                 }
                                 
                                 ace_editor.on('change', function(event, el) {
                                 ace_editor_id = el.container.id;
                                 ace_editor_textarea = document.getElementById(ace_editor_id + '_textarea');
                                 ace_editor_instance = ace.edit(ace_editor_id);
                                 ace_editor_textarea.value = ace_editor_instance.getValue();
                                 });
                                 }*/
</script>
@endpush