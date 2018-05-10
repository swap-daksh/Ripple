@extends('Ripple::layouts.beta-app')
@section('page-title')View role @stop
@section('pate-description') View details of a role @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::roles.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List roles</a>
    <a href="{!! route('Ripple::roles.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add New</a>
    <a href="{!! route('Ripple::roles.edit', ['id'=>$role->id]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit role</a>
    <a href="javascript:void(0);" onClick="document.getElementById('delete_role_{{$role->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Delete role</a>
    <form id="delete_role_{{$role->id}}" action="{!! route('Ripple::roles.destroy', ['id'=>$role->id]) !!}" method="post">@csrf @method('DELETE') </form>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3>{!! $role->name !!}</h3>
                </div>             
            </div>
        </div>
    </div>
</div>
@stop