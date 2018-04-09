@extends('Ripple::layouts.beta-app')
@section('page-title') Database Modules @stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header"><i class="fa fa-database"></i> Database Tables</div>
                <div class="card-body">
                <p class="card-text">
                    Database Tables helps us to monitor all the exists tables in our database. This feature provide us ability to see the database table structure.
                    In future there may be add some more functionality like deleting/editing tables as now we have beta functionaliy to create new table but not completed yet.
                </p>
                <a href="{!! route('Ripple::adminDatabase') !!}" class="btn btn-sm btn-primary">Get Started</a>
                </div>
            </div>
        </div>
        <div class="col">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Database Breads</div>
            <div class="card-body">
                <p class="card-text">
                    Database Bread helps us to create BREAD system for a database table. BREAD stands for Browse Read Edit Add &amp; Delete.
                    By enabling BREAD to database table we can easily Browse, Read, Edit, Add &amp; Delete the data of that particular tabel.
                </p>
                <a href="{!! route('Ripple::databaseTableBreads') !!}" class="btn btn-sm btn-primary">Get Started</a>
            </div>
        </div>
        </div>
        <div class="col">
        <div class="card">
            <div class="card-header"><i class="fa fa-exchange-alt"></i> Database Relations</div>
            <div class="card-body">
                <p class="card-text">
                    Database Relations does a wonderfull job for our BREAD system. As you know what BREAD does behind the secne. 
                    Database relation helps us to visualize the data from other table as a dropdown list so that we can choose the correct
                    table record for that particular column.
                </p>
                <a href="{!! route('Ripple::databaseTableRelationship') !!}" class="btn btn-sm btn-primary">Get Started</a>
            </div>
        </div>
        </div>

    </div>
</div> 
@stop