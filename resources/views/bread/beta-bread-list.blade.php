@extends('Ripple::layouts.beta-app')
@section('page-title') All available bread modules @stop
@section('page-description') List of all bread modules @stop
@section('page-content')
<div class="container-fluid p-3" >
    <div class="row">
    @forelse($breads as $bread)
    <div class="col-md-2">
      <div class="card">
          <div class="card-header">
          {!! $bread->display_plural !!}
          </div>
          <div class="card-body">
            <p>{!! $bread->description !!}</p>
            <a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-primary btn-block">Browse {!! ucfirst($bread->display_singular) !!}</a>
          </div>
          </div>
      </div>
    @empty
    @endforelse
    </div>
</div>
@stop
