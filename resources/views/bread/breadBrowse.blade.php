@extends('Ripple::layouts.app')
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
@section('page-content')
<div class="row">
    <div class="col-md-12">
        <div class="block block-default" data-example-id="togglable-tabs"> 
            <div class="block-heading"><strong style="text-transform: uppercase;">All  {!! $table !!}</strong></div>
            <div class="block-body">
                <div class="table-responsive" style="border:1px solid #F9F9F9;">
                    <table class="table table-striped table-borderless table-header-bg option-wrappers" id="option-wrappers" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                @foreach($columns as $column)
                                @if($column->browse)
                                <th>{!! $column->display_name !!}</th>
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
                                <td colspan="{!! count($columns) !!}">{!! $table !!} has no records yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>
@stop