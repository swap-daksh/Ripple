@extends('Ripple::layouts.beta-app')
@section('page-title') Create New user @stop
@section('page-description') Add a new user to the invertory @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::users.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List users</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
    <div class="col-md-12">
        <div class="card rounded-0">
            <div class="card-body">
                <form class="needs-validation"  novalidate="" method="post" action="{!! route('Ripple::users.update', ['id'=>$user->id]) !!}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="userName">Name</label>
                                    <input class="form-control" id="userName" placeholder="" name="user[name]" value="{{$user->name}}" required="" type="text">
                                    <div class="invalid-feedback">
                                    Valid user Name is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                        <label for="userName"> Display Name</label>
                                        <input class="form-control" id="userName" placeholder="" name="user[display_name]" value="{{$user->display_name}}" required="" type="text">
                                        <div class="invalid-feedback">
                                        Valid user Display Name is required.
                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div class="col-md-12 text-center p-0">
                            <hr>
                            <button type="submit" class="btn w-50 btn-primary"><i class="fa fa-save"></i> Update user</button>
                        </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@stop