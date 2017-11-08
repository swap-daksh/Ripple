@extends('Ripple::layouts.app')
@section('page-content')
<div class="page-header" style="margin: 0px;border-bottom: 1px solid gray;">
    <h1  style="margin: 0px;">Database <small>Tables</small> <a  href="{!! route('Ripple::adminCreateTable') !!}" class="btn btn-success btn-sm">Create Table</a></h1>
</div>
<div id="accordion" class="panel-group">
    @foreach($tables as $table)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#{!! $table.'_'.$loop->index !!}" aria-expanded="false">
                <a class="accordion-toggle collapsed"  href="javascript:void(0);">
                    <i class="fa fa-angle-double-right"></i>&nbsp; {!! strtoupper($table) !!}
                </a>
            </h4>
        </div>
        <div id="{!! $table.'_'.$loop->index !!}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                <a class="btn btn-sm btn-success" href="{!! route('Ripple::adminViewTable', ['table'=>$table]) !!}"><i class="fa fa-eye"></i> View</a>
                <a class="btn btn-sm btn-info" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>
                <a class="btn btn-sm btn-danger" href="javascript:void(0);"><i class="fa fa-trash"></i> Delete</a>
                <a class="btn btn-sm btn-danger" href="{!! route('Ripple::adminCreateBread', ['table'=>$table]) !!}"><i class="fa fa-pencil"></i> Bread</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop