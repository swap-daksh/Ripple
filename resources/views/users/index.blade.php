@extends('Ripple::layouts.beta-app')
@section('page-title') users @stop
@section('page-description') List all users. @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::users.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add users</a>
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
                <th scope="col">Role</th>
                <th scope="col" class="text-center w-10">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->index + 1}}</th>
                    <td class="align-middle">{!! $user->name !!}</td>
                    <td class="align-middle">{!! $user->role !!}</td>
                    <td class="align-middle text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="{!! route('Ripple::users.edit', ['id'=>$user->id]) !!}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{!! route('Ripple::users.show', ['id'=>$user->id]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            <a href="javascript:void(0);" onClick="document.getElementById('delete_user_{{$user->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        <form id="delete_user_{{$user->id}}" action="{!! route('Ripple::users.destroy', ['id'=>$user->id]) !!}" method="post">@csrf @method('DELETE') </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
    </div>
</div>
@stop