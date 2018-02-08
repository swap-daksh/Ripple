@extends('Ripple::layouts.beta-app')
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row">
        <div class="col">
            <div class="card mb-3 rounded-0"> 
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 mx-3 card bg-light">
                            <blockquote class="blockquote my-3">
                                <p class="text-center"><i class="fa fa-globe fa-2x"></i></p>
                                <footer class="blockquote-footer"><a href="{!! route('Ripple::adminSettings', ['type'=>'general']) !!}" class="card-link">General Settings</a></footer>
                            </blockquote>
                        </div>
                        <div class="col-md-2 mx-3 card bg-light">
                            <blockquote class="blockquote my-3">
                                <p class="text-center"><i class="fa fa-globe fa-2x"></i></p>
                                <footer class="blockquote-footer"><a href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}" class="card-link">Bread Settings</a></footer>
                            </blockquote>
                        </div>
                        <div class="col-md-2 mx-3 card bg-light">
                            <blockquote class="blockquote my-3">
                                <p class="text-center"><i class="fa fa-globe fa-2x"></i></p>
                                <footer class="blockquote-footer"><a href="{!! route('Ripple::adminSettings', ['type'=>'sco']) !!}" class="card-link">SCO Settings</a></footer>
                            </blockquote>
                        </div>
                        <div class="col-md-2 mx-3 card bg-light">
                            <blockquote class="blockquote my-3">
                                <p class="text-center"><i class="fa fa-globe fa-2x"></i></p>
                                <footer class="blockquote-footer"><a href="{!! route('Ripple::adminSettings', ['type'=>'social']) !!}" class="card-link">Social Settings</a></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop