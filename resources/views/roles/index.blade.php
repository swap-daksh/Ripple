@extends('Ripple::layouts.beta-app')
@section('page-title') Roles @stop
@section('page-description') List all roles. @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::roles.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Roles</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-12">
        <table class="table border border-1">
            <thead class="thead-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Display Name</th>
                <th scope="col" class="text-center w-10">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->index + 1}}</th>
                    <td class="align-middle">{!! $role->name !!}</td>
                    <td class="align-middle">{!! $role->display_name !!}</td>
                    <td class="align-middle text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="{!! route('Ripple::roles.edit', ['id'=>$role->id]) !!}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{!! route('Ripple::roles.show', ['id'=>$role->id]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            <a href="javascript:void(0);" onClick="document.getElementById('delete_role_{{$role->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        <form id="delete_role_{{$role->id}}" action="{!! route('Ripple::roles.destroy', ['id'=>$role->id]) !!}" method="post">@csrf @method('DELETE') </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
    </div>
</div>
@stop