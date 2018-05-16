@extends('Ripple::layouts.beta-app')

@if(Auth::user()->role == 'admin')
@section('page-title')View user @stop
@section('page-description') View details of a user @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::users.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List users</a>
    <a href="{!! route('Ripple::users.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add New</a>
    <a href="{!! route('Ripple::users.edit', ['id'=>$user->id]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit user</a>
    <a href="javascript:void(0);" onClick="document.getElementById('delete_user_{{$user->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Delete user</a>
    <form id="delete_user_{{$user->id}}" action="{!! route('Ripple::users.destroy', ['id'=>$user->id]) !!}" method="post">@csrf @method('DELETE') </form>
</div>
@stop
@endif

@if(Auth::user()->role == 'dealer')
@section('page-title')Dealer Profile @stop
@section('page-description') Dealer Profile @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::editProfile') !!}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Profile</a>

</div>
@stop

@endif


@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3>{!! $user->name !!}</h3>
                </div>
                <div class="card-body row">
                        <div class="col-md-2"><img style="width:100%" class="img-responsive" src="{!! ripple_asset('/img/default/default.png') !!}" alt=""></div>
                        <div class="col-md-5">
                            <table class="table table-border">
                                <tr>
                                  <td>First Name</td>
                                  <td>{!! $user->name !!}</td>
                                </tr>
                                <tr>
                                  <td>Last Name</td>
                                  <td>{!! $user->last_name !!}</td>
                                </tr>
                                <tr>
                                  <td>Website</td>
                                  <td>{!! $user->website !!}</td>
                                </tr>
                                <tr>
                                  <td>Birthday</td>
                                  <td>{!! $user->birthday !!}</td>
                                </tr>
                                <tr>
                                  <td>Phone No.</td>
                                  <td>{!! $user->phone !!}</td>
                                </tr>
                                <tr>
                                  <td>Role</td>
                                  <td>{!! $user->role !!}</td>
                                </tr>
                              </table>
                            </div>
                        <div class="col-md-5"></div>
                </div>             
            </div>
        </div>
    </div>
</div>
@stop