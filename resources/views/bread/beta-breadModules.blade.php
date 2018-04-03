@extends('Ripple::layouts.beta-app')
@section('page-title') All available bread modules @stop
@section('page-description') List of all bread modules @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::databaseTableBreads') !!}" class="btn btn-success btn-sm"><i class="fa fa-edit "></i> Add/Edit Bread</a>
    <a href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}" class="btn btn-primary btn-sm"><i class="fa fa-cogs"></i> Enable/Disable Bread</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row mb-3">
    @forelse($breads as $bread)
        <div class="col">
            <div class="card h-100 rounded-0">
                <div class="card-header">
                    @if($bread->icon !== '')
                    <i class="fa fa-{!! $bread->icon !!}"></i>
                    @else
                    <i class="fas fa-th"></i>
                    @endif
                    {!! ucfirst($bread->display_plural) !!}
                </div>
                <div class="card-body">
                    <p class="card-text">
                        @if($bread->description !== '')
                        @else
                            This is default description of <strong>{!! ucfirst($bread->display_plural) !!}</strong>. You can update the BREAD 
                            description by editing this bread.
                        @endif
                    </p>
                    <a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-sm btn-primary">Browse</a>
                </div>
            </div>
        </div>
        @php $count = $loop->index + 1; @endphp
        @if(($count % 4) == 0)
        </div>
        <div class="row mb-3">
        @endif
    @empty
        <div class="alert alert-danger col" role="alert">
            <h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> Oops!</h4>
            <p>Aww, seems that you have not created any bread modules yet.</p>
            <hr>
            <p class="mb-0"><a href="{!! route('Ripple::databaseTableBreads') !!}" class="alert-link">Click here</a> to create new bread module or click to <strong>Add New Bread</strong> button in page title bar.</p>
        </div>
    @endforelse
    </div>
</div>
@stop
