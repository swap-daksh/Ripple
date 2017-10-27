@extends('Ripple::layouts.app')
@section('page-content')
<form action=""  method="post" class="" enctype="Multipart/form-data">
    {!! csrf_field() !!}
    <input type="hidden" value="zzz" name="post-create">
    <input type="hidden" value="post" name="post-type">
    <input type="hidden" value="1" name="post-author">

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">Create New Post</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="">Post Title</label>
                    <input type="text" name="post-title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Post Content</label>
                    <textarea type="text" name="post-content" class="form-control ripple_text_editor" rows="11"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Post Excerpt</label>
                    <textarea name="post-excerpt" class="form-control" id="" rows="4" placeholder="Excerpt"></textarea>
                </div>
                <!--<div class="col-md-12">-->
                <label for="">Post Categories & Tags</label>
                <div class="block block-default" data-example-id="togglable-tabs" style="border-width: 2px;border-bottom-right-radius: 4px;border-bottom-left-radius: 4px;"> 
                    <ul class="nav nav-tabs" id="myTabs" role="tablist"> 
                        <li role="presentation" class="active">
                            <a href="#categories-tab" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><i class="fa fa-folder-open"></i> Categories</a>
                        </li> 
                        <li role="presentation" class="">
                            <a href="#tags-tab" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><i class="fa fa-tags"></i> Tags</a>
                        </li> 
                        <li role="presentation" class="pull-right dropdown"> 
                            <a href="#" class="dropdown-toggle pointer" id="myTabDrop1" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></a> 
                            <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents"> 
                                <li class=""><a href="#create-tag-tab" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="create-tag-tab" aria-expanded="false"><i class="fa fa-tag"></i> Create Tag</a></li> 
                                <li class=""><a href="#create-category-tab" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="create-category-tab" aria-expanded="false"><i class="fa fa-folder-open"></i> Create Category</a></li>
                            </ul> 
                        </li> 
                    </ul> 
                    <div class="tab-content" id="myTabContent"> 
                        <div class="tab-pane fade active in" role="tabpanel" id="categories-tab" aria-labelledby="categories-tab"> 
                            @foreach(Ripple::allCategories() as $category)
                            <label for="category-{!! $category->id !!}" class="css-input btn checkbox-category btn-default css-checkbox css-checkbox-primary">
                                <input id="category-{!! $category->id !!}" name="post-category[]" value="{!! $category->id !!}" type="checkbox">
                                <span></span> 
                                {!! $category->name !!}
                            </label>
                            @endforeach
                            <label for="" class="label label-info"><input type="checkbox" style="display:none;" id="" ><i class="fa fa-folder"></i> Uncategorised</label>
                            <label for="" class="label label-info"><input type="checkbox" style="display:none;" id="" ><i class="fa fa-folder"></i> Shoping</label>
                            <label for="" class="label label-info"><input type="checkbox" style="display:none;" id="" ><i class="fa fa-folder"></i> Clothing</label>
                            <label for="" class="label label-info"><input type="checkbox" style="display:none;" id="" ><i class="fa fa-folder"></i> Lifestyle</label>
                        </div> 
                        <div class="tab-pane fade" role="tabpanel" id="tags-tab" aria-labelledby="tags-tab"> 
                            @foreach(Ripple::allTags() as $tag)
                            <label for="tag-{!! $tag->id !!}" class="btn btn-default checkbox-tag css-input css-checkbox css-checkbox-info">
                                <input id="tag-{!! $tag->id !!}" name="post-tag[]" value="{!! $tag->id !!}" type="checkbox">
                                <span></span> 
                                {!! $tag->name !!}
                            </label>
                            @endforeach
                            <label for="" class="label label-info"><input type="checkbox" style="display:none;" id="" ><i class="fa fa-tag"></i> Uncategorised</label>
                            <label for="" class="label label-info"><input type="checkbox" style="display:none;" id="" ><i class="fa fa-tag"></i> Shoping</label>
                            <label for="" class="label label-info"><input type="checkbox" style="display:none;" id="" ><i class="fa fa-tag"></i> Clothing</label>
                            <label for="" class="label label-info"><input type="checkbox" style="display:none;" id="" ><i class="fa fa-tag"></i> Lifestyle</label>
                        </div> 
                        <div class="tab-pane fade" role="tabpanel" id="create-category-tab" aria-labelledby="create-category-tab"> 
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Category Title">
                            </div>
                            <div class="form-group">
                                <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder="Category Description"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-folder-open-o"></i> Create Category</button>
                            </div>
                        </div> 
                        <div class="tab-pane fade" role="tabpanel" id="create-tag-tab" aria-labelledby="create-tag-tab"> 
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Tag Title">
                            </div>
                            <div class="form-group">
                                <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder="Tag Description"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-tag"></i> tag</button>
                            </div>
                        </div> 
                    </div> 
                </div>
                <!--</div>-->
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">Publish</div>
            <div class="panel-body">
                <p><i class="fa fa-flag"></i> Status: <b id="current-status">Draft</b> <a href="javascript:void(0);" class="pull-right"><i class="fa fa-pencil-square-o"></i></a></p>
                <input value="draft" name="post-status" id="post-status" type="hidden">
                <p><i class="fa fa-eye"></i> Visibility: <b id="current-status">Public</b> <a href="javascript:void(0);" class="pull-right"><i class="fa fa-pencil-square-o"></i></a></p>
                <input value="public" name="post-visibility" type="hidden">
                <p><i class="fa fa-comments"></i> Comments: <b id="current-status">Open</b> <a href="javascript:void(0);" class="pull-right"><i class="fa fa-pencil-square-o"></i></a></p>
                <input value="open" name="post-comments" type="hidden">
            </div>
            <div class="panel-footer text-center">
                <button class="btn btn-primary btn-rounded btn-sm" type="submit">Publish Post</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Featured Image <span class="pull-right"><i class="fa fa-photo" style="font-size: 18px"></i></span></div>
            <div class="panel-body text-center">
                <div class="clearfix" id="featured-image">
                    <img class="img-responsive" src="http://127.1.1.3/AdminPanel/public/vendor/gitlab/ripple/public/img/default/default.png" alt="" width="200" height="200">
                </div>
            </div>
            <div class="panel-footer text-center">
                <input class="image-preview" name="post-image" id="post-image" data-preview="featured-image" style="display:none;" type="file">
                <button class="btn btn-primary btn-rounded btn-sm" type="button" onclick="document.getElementById('post-image').click();">Change Image</button>
            </div>
        </div>
    </div>
</form>


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