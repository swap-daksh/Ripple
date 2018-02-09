@extends('Ripple::layouts.beta-app')
@section('page-title') Dashboard @stop
@section('page-content')
<div class="container-fluid p-3"> 
    <div class="row">
        <div class="col"> 
            <div class="card rounded-0 border-0">
                <div class="card-body clearfix">
                    <div class="card-deck text-center">
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">Bread Module</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title invisible">$0 <small class="text-muted">/ mo</small></h1>
                                <ul class="list-unstyled mt-3 mb-4 invisible">
                                    <li>10 users included</li>
                                    <li>2 GB of storage</li>
                                    <li>Email support</li>
                                    <li>Help center access</li>
                                </ul>
                                <a href="{!! route('Ripple::breadModule') !!}" class="btn btn-lg btn-block btn-outline-primary">Get Started</a>
                            </div>
                        </div>
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">Database Module</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title invisible">$15 <small class="text-muted">/ mo</small></h1>
                                <ul class="list-unstyled mt-3 mb-4 invisible">
                                    <li>20 users included</li>
                                    <li>10 GB of storage</li>
                                    <li>Priority email support</li>
                                    <li>Help center access</li>
                                </ul>
                                <a href="{!! route('Ripple::databaseModule') !!}" class="btn btn-lg btn-block btn-outline-primary">Get Started</a>
                            </div>
                        </div>
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">Settings Modules</h4>
                            </div>
                            <div class="card-body ">
                                <h1 class="card-title pricing-card-title invisible">$29 <small class="text-muted">/ mo</small></h1>
                                <ul class="list-unstyled mt-3 mb-4 invisible">
                                    <li>30 users included</li>
                                    <li>15 GB of storage</li>
                                    <li>Phone and email support</li>
                                    <li>Help center access</li>
                                </ul>
                                <a href="{!! route('Ripple::settingModule') !!}" class="btn btn-lg btn-block btn-outline-primary">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop