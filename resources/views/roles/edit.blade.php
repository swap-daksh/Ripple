@extends('Ripple::layouts.beta-app')
@section('page-title') Create New role @stop
@section('page-description') Add a new role to the invertory @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::roles.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List roles</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
    <div class="col-md-12">
        <div class="card rounded-0">
            <div class="card-body">
                <form class="needs-validation"  novalidate="" method="post" action="{!! route('Ripple::roles.update', ['id'=>$role->id]) !!}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="roleName">Name</label>
                                    <input class="form-control" id="roleName" placeholder="" name="role[name]" value="{{$role->name}}" required="" type="text">
                                    <div class="invalid-feedback">
                                    Valid Role Name is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                        <label for="roleName"> Display Name</label>
                                        <input class="form-control" id="roleName" placeholder="" name="role[display_name]" value="{{$role->display_name}}" required="" type="text">
                                        <div class="invalid-feedback">
                                        Valid Role Display Name is required.
                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div class="col-md-12 text-center p-0">
                            <hr>
                            <button type="submit" class="btn w-50 btn-primary"><i class="fa fa-save"></i> Update role</button>
                        </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@stop