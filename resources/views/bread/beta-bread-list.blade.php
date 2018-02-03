@extends('Ripple::layouts.beta-app')
@section('page-title') All available bread modules @stop
@section('page-description') List of all bread modules @stop
@section('page-content')
<div class="container-fluid p-3" >
    <div class="row">
    @forelse($breads as $bread)
    <div class="col-md-3 mb-3">
      <div class="card h-100">
          <div class="card-header">
          {!! ucfirst($bread->display_plural) !!}
          </div>
          <div class="card-body text-justify">
            @if(empty($bread->description))
              <p>This is bread default BREAD module description. Basically Bread stands for <b>B</b>rowse <b>R</b>ead <b>E</b>dit <b>A</b>dd & <b>D</b>elete operations.</p>
            @else
              <p>{!! $bread->description !!}</p>
            @endif

          </div>
          <div class="card-footer">
            <a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-primary btn-block">Browse {!! ucfirst($bread->display_plural) !!}</a>
          </div>
          </div>
      </div>
    @if((($loop->index + 1) % 4) === 0)
    </div>
    <div class="row">
    @endif
    @empty
    @endforelse
    </div>
</div>
@stop
