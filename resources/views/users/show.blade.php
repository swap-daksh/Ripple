@extends('Ripple::layouts.beta-app')
@section('page-title')View user @stop
@section('pate-description') View details of a user @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::users.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List users</a>
    <a href="{!! route('Ripple::users.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add New</a>
    <a href="{!! route('Ripple::users.edit', ['id'=>$user->id]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit user</a>
    <a href="javascript:void(0);" onClick="document.getElementById('delete_user_{{$user->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Delete user</a>
    <form id="delete_user_{{$user->id}}" action="{!! route('Ripple::users.destroy', ['id'=>$user->id]) !!}" method="post">@csrf @method('DELETE') </form>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3>{!! $user->name !!}</h3>
                </div>             
            </div>
        </div>
    </div>
</div>
@stop