@extends('Ripple::layouts.beta-app')
@section('btn-add-new') 
<div class="col text-right p-0">
<a href="{!! route('Ripple::adminBreadAdd', ['slug'=>$bread->slug]) !!}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New {!! ucfirst($bread->display_singular) !!}</a>
<a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Browse {!! ucfirst($bread->display_plural) !!}</a>
</div>
@stop
@section('page-content')

<div class="container-fluid p-3"> 
    <div class="col-md-12 p-0">
        <div class="card rounded-0">
            <div class="card-header bg-dark rounded-0 text-white">
                <i class="fa fa-pencil-square-o fa-2x"></i> Update {!! ucfirst(str_singular($table)) !!}
            </div>
            <div class="card-body">
                <form action="" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="hidden" name="bread-edit" value="1">
                    <input type="hidden" name="table" value="{!! $table !!}" />
                    <input type="hidden" name="edit-id" value="{!! $edit->id !!}" />
                    <div class="row">
                    @foreach($columns as $column)
                    @if($column->add)
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{!! strtoupper($column->display_name) !!}</label>
                        @switch($column->type)
                        @case('text')
                            <input class="form-control" value="{!! $edit->{$column->column} !!}" type="text" name="column[{!! $column->column !!}]">
                        @break
                        @case('textarea')
                            <textarea name="column[{!! $column->column !!}]" id="" cols="30" rows="5" class="form-control">{!! $edit->{$column->column} !!}</textarea>
                        @break
                        @endswitch 
                    </div>
                    </div>
                    @endif
                    @endforeach
                    <div class="col text-center mx-auto">
                    <hr>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-cloud-upload"></i> Update {!! ucfirst(str_singular($bread->display_singular)) !!}</button>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop