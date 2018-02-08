@extends('Ripple::layouts.beta-app')
@section('page-title') Browse All {!! ucfirst($table) !!} @stop
@section('btn-add-new') 
<div class="col p-0"><a href="{!! route('Ripple::adminBreadAdd', ['slug'=>$bread->slug]) !!}" class="float-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add {!! ucfirst($bread->display_singular) !!}</a></div>
@stop
@section('page-content')
<div class="container-fluid p-3"> 
    <div class="col-md-12 border p-3">
        <div class="table-responsive">
            <table class="table table-striped table-borderless table-header-bg option-wrappers" id="option-wrappers" style="margin-bottom: 0px;">
                <thead class="thead-dark">
                    <tr>
                        @foreach($columns as $column)
                        @if($column->browse)
                        <th>{!! strtoupper($column->display_name) !!}</th>
                        @endif
                        @endforeach
                        <th class="w-10 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                    <tr>
                        @foreach($columns as $column)
                        @if($column->browse)
                        <td>{!! $record->{$column->column} !!}</td>
                        @endif
                        @endforeach
                        <td class="text-center">
                            <a href="{!! route('Ripple::adminBreadEdit', ['slug'=>$bread->slug, 'id'=>$record->id]) !!}" class="btn btn-sm btn-success">
                                <i class="fa fa-pencil"></i>
                            </a> 
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{!! count($columns) +1 !!}">{!! ucfirst($table) !!} has no records yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> 
</div>

@stop