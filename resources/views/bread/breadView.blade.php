@extends('Ripple::layouts.beta-app')
@section('page-title') View {!! ucfirst($bread->display_singular) !!} @stop
@section('buttons') 
<div class="buttons">
    <a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Browse {!! ucfirst($bread->display_plural) !!}</a>
    <a href="{!! route('Ripple::adminBreadAdd', ['slug'=>$bread->slug]) !!}" class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Add {!! ucfirst($bread->display_singular) !!}</a>
    <a href="{!! route('Ripple::adminBreadEdit', ['slug'=>$bread->slug, 'id'=>$view->data->id]) !!}" class="btn btn-success btn-sm"> <i class="fa fa-pencil-square-o"></i> Edit {!! ucfirst($bread->display_singular) !!}</a>
    <a href="{!! route('Ripple::adminBreadDelete', ['slug'=>$bread->slug, 'id'=>$view->data->id]) !!}" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Trash {!! ucfirst($bread->display_singular) !!}</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3"> 
    <div class="col-md-12 p-0">
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    @foreach($view->columns as $column)
                    @if($column->browse)
                    <div class="col-md-6">
                        <div class="list-group m-2">
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{!! strtoupper($column->display_name) !!}</h5>
                                    <small><i>{!! $column->display_name !!}</i></small>
                                </div>
                                @if(Relation::hasRelation($bread->table, $column->column))
                                <p class="mb-1"><i>&nbsp;{!! Relation::get_value($bread->table, $column->column, $view->data->{$column->column}) !!}</i></p>
                                @else 
                                <p class="mb-1"><i>&nbsp;{!! $view->data->{$column->column} !!}</i></p>
                                @endif 
                                
                            </a>
                        </div>
                    </div>
                    @endif
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
</div>
@stop