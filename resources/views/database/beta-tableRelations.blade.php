@extends('Ripple::layouts.beta-app')
@section('page-title') Database table relations @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::databaseModule') !!}" class="btn btn-primary btn-sm"><i class="fa fa-database"></i> Database Modules</a>
    <a href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}" class="btn btn-info btn-sm"><i class="fa fa-cogs"></i> Bread Settings</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3"> 
    <div class="col-md-12 p-0">
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="card-header">
                                Create New Relation
                            </div>
                            <div class="card-body">
                                    Card Relations
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="card-header">
                                Table Relations
                            </div>
                            <div class="card-body">
                                div card body
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid p-3">
    <div class="row">
        
    </div>
</div>
@stop