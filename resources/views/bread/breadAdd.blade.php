@extends('Ripple::layouts.beta-app')
@section('page-title') Create New {!! ucfirst(str_singular($table)) !!} @stop
@section('btn-add-new') 
<div class="col text-right p-0">
<a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Browse {!! ucfirst($bread->display_plural) !!}</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header">
                    New {!! ucfirst(str_singular($table)) !!}
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="bread-add" value="1">
                    <input type="hidden" name="table" value="{!! $table !!}" />
                    <div class="row">
                    @foreach($columns as $column)
                    @if($column->add)
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{!! strtoupper($column->display_name) !!}</label>
                        @switch($column->type)
                        @case('text')
                            <input class="form-control" type="text" name="column[{!! $column->column !!}]">
                        @break
                        @case('textarea')
                            <textarea name="column[{!! $column->column !!}]" id="" cols="30" rows="5" class="form-control"></textarea>
                        @break
                        @endswitch 
                    </div>
                    </div>
                    @endif
                    @endforeach
                    </div>
                    <div class="col">
                    <button class="btn btn-primary" type="submit">Save {!! ucfirst(str_singular($table)) !!}</button>   
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop