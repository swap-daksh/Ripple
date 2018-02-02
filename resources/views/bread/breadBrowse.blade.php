@extends('Ripple::layouts.beta-app')
@section('page-title') Browse All {!! ucfirst($table) !!} @stop
@section('page-content')
<div class="container-fluid p-3"> 
    <div class="row">
    <div class="col">
    <div class="card">
        <div class="card-header">
            <h5>All {!! $table !!}</h5>
        </div>
        <div class="card-body">
        <div class="table-responsive" style="border:1px solid #F9F9F9;">
                    <table class="table table-striped table-borderless table-header-bg option-wrappers" id="option-wrappers" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                @foreach($columns as $column)
                                @if($column->browse)
                                <th>{!! strtoupper($column->display_name) !!}</th>
                                @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($records as $record)
                            <tr>
                                @foreach($columns as $column)
                                @if($column->browse)
                                <th>{!! $record->{$column->column} !!}</th>
                                @endif
                                @endforeach
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{!! count($columns) !!}">{!! ucfirst($table) !!} has no records yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    </div>
    </div>

</div>

@stop