@extends('Ripple::layouts.app')
@section('page-content')
<div class="page-header" style="margin: 0px;">
    <h1  style="margin: 0px;">Database <small>Tables</small> <a  href="{!! route('Ripple::adminCreateTable') !!}" class="btn btn-success btn-sm">Create Table</a></h1>
</div>
<div class="col-md-12 box-block box-default clearfix">
    <div class="box-head">
        <h3 class="box-title">Data Base</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-inverse">
                    <tr>
                        <th class="text-center" style="width: 20px;"><i class="fa fa-photo text-info"></i></th>
                        <th>Display Name</th>
                        <th style="width: 30%;">Table Name</th>
                        <th style="width: 15%;">Bread</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table) 
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-info-circle text-info"></i>
                        </td>
                        <td class="font-w600">{!! ucwords(str_replace('_', ' ', $table)) !!}</td>
                        <td><code>{!! $table !!}</code></td>
                        <td>
                            @if(Ripple::hasEnabledBread($table))
                            @if(DB::table('breads')->where('table', $table)->exists())
                            <a class="btn btn-xs btn-info btn-block" href="{!! route('Ripple::adminEditBread', ['table' => $table]) !!}"><i class="fa fa-pencil-square-o"></i> Update</a>
                            @else
                            <a class="btn btn-xs btn-success btn-block" href="{!! route('Ripple::adminCreateBread', ['table'=>$table]) !!}"><i class="fa fa-pencil"></i> Create</a>
                            @endif
                            @else
                            <a class="btn btn-xs btn-warning disabled btn-block" href="javascript:void(0);"><i class="fa fa-ban "></i> Disabled</a>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a class="btn btn-xs btn-success" href="{!! route('Ripple::adminViewTable', ['table'=>$table]) !!}" data-toggle="tooltip" title="" data-original-title="View Table"><i class="fa fa-eye"></i></a>

                                <button class="btn btn-xs btn-danger" type="button" data-toggle="tooltip" title="" data-original-title="Delete Table"><i class="fa fa-times"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop