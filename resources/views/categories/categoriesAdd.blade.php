@extends('Ripple::layouts.beta-app')
@section('page-title') Add New Category @stop
@section('buttons')
    <div class="buttons">
        <a href="javascript:void(0);" onClick="document.getElementById('create-category').submit();" class=" btn btn-success btn-sm"> <i class="fa fa-save"></i> Save Category</a>
        <a href="{!! route('Ripple::adminIndexCategories') !!}" class=" btn btn-primary btn-sm"> <i class="fa fa-list"></i> List Categories</a>
    </div>
@stop
@section('page-content')
    <div class="container-fluid p-3 mt-3">
        <div class="row">
            <div class="col">
                <div class="card border-0 rounded-0">
                    <div class="card-body">
                        <form action="" method="post" id="create-category" class="row">
                            {!! csrf_field() !!}
                            <input type="hidden" name="new-category" value="1">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="category-title">Category Title</label>
                                    <input type="text" name="category[name]" id="category-title" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="category-title">Category Type</label>
                                    <select name="category[type]" class="custom-select">
                                        <option value="category">Category</option>
                                        <option value="tag">Tag</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="category-title">Category Parent</label>
                                    <select name="category[parent]" class="custom-select">
                                        <option value="0">---- No Parent ----</option>
                                        @foreach(DB::table(prefix('categories'))->get() as $category)
                                            @if($category->parent == 0)
                                                <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                                            @endif
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="category-title">Category Description</label>
                                <textarea name="category[description]" id="" cols="30" rows="5" class="form-control">&nbsp;</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop