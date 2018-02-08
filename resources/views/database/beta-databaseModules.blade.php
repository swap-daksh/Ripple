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
                                <p class="text-center"><i class="fa fa-database fa-2x"></i></p>
                                <footer class="blockquote-footer"><a href="{!! route('Ripple::adminDatabase') !!}" class="card-link">Database Tables</a></footer>
                            </blockquote>
                        </div>
                        <div class="col-md-2 mx-3 card bg-light">
                            <blockquote class="blockquote my-3">
                                <p class="text-center"><i class="fa fa-plus fa-2x"></i></p>
                                <footer class="blockquote-footer"><a href="{!! route('Ripple::adminCreateTable') !!}" class="card-link">Create Table</a></footer>
                            </blockquote>
                        </div>
                        <div class="col-md-2 mx-3 card bg-light">
                            <blockquote class="blockquote my-3">
                                <p class="text-center"><i class="fa fa-angle-double-right fa-2x"></i><i class="fa fa-angle-double-left fa-2x"></i></p>
                                <footer class="blockquote-footer"><a href="{!! route('Ripple::databaseTableRelationship') !!}" class="card-link">Table Relations</a></footer>
                            </blockquote>
                        </div>
                        <div class="col-md-2 mx-3 card bg-light">
                            <blockquote class="blockquote my-3">
                                <p class="text-center"><i class="fa fa-angle-double-right fa-2x"></i><i class="fa fa-angle-double-left fa-2x"></i></p>
                                <footer class="blockquote-footer"><a href="{!! route('Ripple::databaseTableBreads') !!}" class="card-link">Table Breads</a></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop