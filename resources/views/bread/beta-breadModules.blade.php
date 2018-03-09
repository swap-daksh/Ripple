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
    <div class="row">
        <div class="col">
            <div class="card mb-3 rounded-0 border-0"> 
                <div class="card-body p-0">
                    <div class="row px-3">

                        @forelse($breads as $bread)
                        <div class="col-md-2 p-1 ">
                            <div class="card my-1 bg-light">
                                <blockquote class="blockquote m-2">
                                    <p class="text-center"> 
                                        @if($bread->icon !== '')
                                        <i class="fa fa-{!! $bread->icon !!} fa-2x"></i>
                                        @else
                                        <i class="fab fa-2x"></i>
                                        @endif
                                    </p>
                                    <footer class="blockquote-footer"><a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="card-link">{!! ucfirst($bread->display_plural) !!}</a></footer>
                                </blockquote>
                            </div>
                        </div>
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
            </div>
        </div>
    </div>
</div>
@stop
