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
            <div class="block-heading"><strong style="text-transform: uppercase;">Add {!! $table !!}</strong></div>
            <div class="block-body">
                General Settings
            </div>
        </div>
    </div>
    <h1>Add {!! $table !!}</h1>
</div>
@stop