@extends('Ripple::layouts.beta-app')
@section('page-title') Database Table Breads @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::databaseModule') !!}" class="btn btn-primary btn-sm"><i class="fa fa-database"></i> Database Modules</a>
    <a href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}" class="btn btn-info btn-sm"><i class="fa fa-cogs"></i> Bread Settings</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row">
        <div class="col">
            <div class="card mb-3 rounded-0"> 
                <div class="card-body">
                    <div class="row px-3">
                        @foreach($tables as $table)
                            @if(substr($table, 0, 3) !== 'rpl' && $table !== 'migrations')
                            <div class="col-md-2 p-1 ">
                                <div class="card my-1 bg-light">
                                <blockquote class="blockquote m-2">
                                    <p class="text-center m-0"><i class="fab "></i></p>
                                    <p class=""><code> {!! $table !!}</code></p>
                                    <footer class="blockquote-footer">
                                    @if(DB::table('rpl_breads')->where('table', $table)->exists())
                                    <a href="{!! route('Ripple::adminEditBread', ['table' => $table]) !!}" class="card-link text-success">Update</a> 
                                    @else
                                    <a href="{!! route('Ripple::adminCreateBread', ['table'=>$table]) !!}" class="card-link">Create</a>
                                    {{--<a class="btn btn-sm btn-success btn-block" href=""><i class="fa fa-pencil"></i> Create</a>--}}
                                    @endif 
                                    </footer>
                                </blockquote>
                                    </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop