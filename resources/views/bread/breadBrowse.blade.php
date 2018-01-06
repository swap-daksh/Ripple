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
                                <th></th>
                                <th>Name</th>
                                <th>Value</th>
                                <th class="text-center">
                                    <i class="fa fa-plus add-options text-info" style="cursor: pointer" id="add-options" data-id="add-options"></i>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>
@stop