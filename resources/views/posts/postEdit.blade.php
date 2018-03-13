@extends('Ripple::layouts.beta-app')
@section('page-title') {!! $post->title !!} @stop
@section('buttons') 
<div class="buttons">
<a href="{!! route('Ripple::adminPostAdd') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add New</a>
    <a href="{!! route('Ripple::adminPostIndex') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> List Posts</a>
</div>
@stop
@section('page-content') 
<div class="container-fluid p3 mt-3">
    
    <form action="" method="post" enctype="Multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" value="zzz" name="post-update">
        <input type="hidden" value="post" name="post-type">
        <input type="hidden" value="{!! $post->id !!}" name="post-id">
        <input type="hidden" value="1" name="post-author">
        <div class="row">
            <div class="col-md-8">
                <div class="card rounded-0">
                    <div class="card-header"><i class="far fa-file-alt"></i> Post Content</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Post Title: </label>
                            <input type="text" name="post-title" value="{!! $post->title !!}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Post Content</label>
                            <textarea type="text" name="post-content" class="form-control ripple_text_editor" rows="11">{!! $post->content !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Post Excerpt</label>
                            <textarea name="post-excerpt" class="form-control" id="" rows="4" placeholder="Excerpt">{!! $post->excerpt !!}</textarea>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card rounded-0 mb-3">
                    <div class="card-header"><i class="fas fa-cog"></i> Post Settings</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Post Comments</label>
                                    <select name="post-comments" id="" class="custom-select">
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Post Visibility</label>
                                    <select name="post-visibility" id="" class="custom-select">
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Post Tags</label>
                                    <select name="post-tag" multiple class="custom-select multipleSelect">
                                    @foreach(Ripple::allTags() as $tag)
                                    <option value="asdf">sdf</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Post Categories</label>
                                    <select name="post-category" multiple class="custom-select multipleSelect">
                                        <option value="asdf">sdf</option>
                                        <option value="asdfw">sdfse</option>
                                        <option value="asdf4">sdfwe</option>
                                        <option value="asdfwe">sdfwe</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        
                        

                        
                        <div class="form-group">
                            <label for="">Post Status</label>
                            <select name="post-status" id="" class="custom-select">
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        
                        
                        <input type="submit" value="Update" class="text-capitalize col btn btn-primary btn-sm">
                    </div>
                </div>
                <div class="card rounded-0">
                    <div class="card-header"><i class="fa fa-image" style="font-size: 18px"></i> Featured Image</div>
                    <div class="card-body">
                        <div class="clearfix" id="featured-image">
                            @if(is_null($post->image))
                            <img width="200" height="200" class="img-responsive" src="{!! ripple_asset('/img/default/default.png') !!}" alt="">
                            @else
                            <img width="100%" height="200" class="img-responsive" src="{!! url(Storage::url($post->image)) !!}" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="custom-file">
                            <input class="image-preview custom-file-input" name="post-image" id="post-image" data-preview="featured-image" data-width="100%" data-height="200" type="file">
                            <label class="custom-file-label" for="post-image">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@foreach(Ripple::allCategories() as $category)
<label for="category-{!! $category->id !!}" class="css-input btn checkbox-category btn-default css-checkbox css-checkbox-primary">
    <input id="category-{!! $category->id !!}" name="post-category[]" value="{!! $category->id !!}" type="checkbox">
    <span></span> 
    {!! $category->name !!}
</label>
@endforeach
@foreach(Ripple::allTags() as $tag)
<label for="tag-{!! $tag->id !!}" class="btn btn-default checkbox-tag css-input css-checkbox css-checkbox-info">
    <input id="tag-{!! $tag->id !!}" name="post-tag[]" value="{!! $tag->id !!}" type="checkbox">
    <span></span> 
    {!! $tag->name !!}
</label>
@endforeach
@stop
@push('page-script') 
<link rel="stylesheet" href="{!! ripple_asset('/lib/css/select2/select2.min.css') !!}"/>
<script src="{!! ripple_asset('/lib/js/select2/select2.min.js') !!}" type="text/javascript" charset="utf-8"></script>
<script src="{!! ripple_asset('/lib/js/slimscroll/slimscroll.min.js') !!}" type="text/javascript" charset="utf-8"></script>
<script src="{!! ripple_asset('/lib/js/ace/ace.js') !!}" type="text/javascript" charset="utf-8"></script>
<script>
    

    $(".select2_demo_3").select2({
        placeholder: "Select a state",
        allowClear: false
    });
    $(".multipleSelect").select2({
        placeholder: "Categories",
//            allowClear: true
    });
  /*  var editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/php");
//    alert(editor.getValue());
    editor.on('change', function () {
        document.getElementById('code-editor').value = editor.getValue();
    });*/
</script>
@endpush