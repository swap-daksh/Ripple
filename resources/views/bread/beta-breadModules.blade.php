@extends('Ripple::layouts.beta-app')
@section('page-title') All available bread modules @stop
@section('page-description') List of all bread modules @stop
@section('page-content')
<div class="container-fluid p3 mt-3"  ng-app="NewBread" ng-controller="CreateNewBread">
    <div class="row">
        <div class="col">
            <div class="card mb-3 rounded-0"> 
                <div class="card-body">
                    <div class="row">
                      @forelse($breads as $bread)
                        <div class="col-md-2 mx-3 mb-3 card bg-light">
                            <blockquote class="blockquote my-3">
                                <p class="text-center">
                                  @if($bread->icon !== '')
                                  <i class="fa fa-{!! $bread->icon !!} fa-2x"></i>
                                  @else
                                  <i class="fa fa-list fa-2x"></i>
                                  @endif
                                  
                                </p>
                                <footer class="blockquote-footer"><a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="card-link">{!! ucfirst($bread->display_plural) !!}</a></footer>
                            </blockquote>
                        </div>
                        @empty
                      @endforelse 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
