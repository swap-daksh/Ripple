@extends('Ripple::layouts.beta-app')
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">General Settings</div>
                <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <a href="{!! route('Ripple::adminSettings', ['type'=>'general']) !!}" class="btn btn-sm btn-primary">Browse Settings</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Bread Settings</div>
                <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <a href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}" class="btn btn-sm btn-primary">Browse Settings</a>
                </div>
            </div>
        </div>
        <div class="col">
        <div class="card">
            <div class="card-header">SCO Settings</div>
            <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <a href="{!! route('Ripple::adminSettings', ['type'=>'sco']) !!}" class="btn btn-sm btn-primary">Browse Settings</a>
            </div>
        </div>
        </div>
        <div class="col">
        <div class="card">
            <div class="card-header">Social Settings</div>
            <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <a href="{!! route('Ripple::adminSettings', ['type'=>'social']) !!}" class="btn btn-sm btn-primary">Browse Settings</a>
            </div>
        </div>
        </div>
    </div>
</div>
@stop