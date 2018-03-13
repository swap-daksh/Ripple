@extends('Ripple::layouts.beta-app')
@section('page-title') Browse All {!! ucfirst($table) !!} @stop
@section('buttons') 
<div class=""> 
    <a href="{!! route('Ripple::adminBreadAdd', ['slug'=>$bread->slug]) !!}" class="float-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add {!! ucfirst($bread->display_singular) !!}</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3"> 
    <div class="col-md-12 border p-0">
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
                        @if(Relation::hasRelation($bread->table, $column->column))
                        <td>{!! Relation::get_value($bread->table, $column->column, $record->{$column->column}) !!}</td>
                        @else
                        <td>{!! $record->{$column->column} !!}</td>
                        @endif 
                        @endif
                        @endforeach
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <a href="{!! route('Ripple::adminBreadEdit', ['slug'=>$bread->slug, 'id'=>$record->id]) !!}" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                
                                <a href="{!! route('Ripple::adminBreadView', ['slug'=>$bread->slug, 'id'=>$record->id]) !!}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
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