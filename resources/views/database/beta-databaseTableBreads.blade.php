@extends('Ripple::layouts.beta-app')
@section('page-title') Database Table Breads @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::databaseModule') !!}" class="btn btn-primary btn-sm"><i class="fa fa-database"></i> Database Modules</a>
    <a href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}" class="btn btn-info btn-sm"><i class="fa fa-cogs"></i> Enable/Disable Bread</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row mb-5">
        <div class="col">
            <div class="card h-100">
                <div class="card-header">Bread Tables</div>
                <div class="card-body">
                @forelse($tables as $table)
                
                @if(substr($table, 0, 3) !== 'rpl' && $table !== 'migrations')
                @if(DB::table('rpl_breads')->where('table', $table)->exists())
                    <div class="card mb-2">
                        <div class="card-header">
                            {!! $table !!}
                            <div class="float-right">
                                <a href="{!! route('Ripple::adminEditBread', ['table' => $table]) !!}" class="badge badge-primary p-2"><i class="fas fa-edit"></i>    Update</a> 
                            </div>
                        </div>
                    </div>
                @endif
                @endif
                @empty

                @endforelse
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header">
                    Create Bread Table
                </div>
                <div class="card-body">
                @forelse($tables as $table)
                
                @if(substr($table, 0, 3) !== 'rpl' && $table !== 'migrations')
                @if(!DB::table('rpl_breads')->where('table', $table)->exists())
                    <div class="card mb-2">
                        <div class="card-header">
                            {!! $table !!}
                            <div class="float-right">
                                <a href="{!! route('Ripple::adminCreateBread', ['table'=>$table]) !!}" class="badge badge-success p-2"><i class="fas fa-plus-circle"></i> Create</a> 
                            </div>
                        </div>
                    </div>
                @endif
                @endif
                @empty

                @endforelse
                </div>
            </div>
        </div>
    </div> 
</div>
@stop