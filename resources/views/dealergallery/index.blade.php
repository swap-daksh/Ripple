@extends('Ripple::layouts.beta-app')

@section('page-title') Old Cars Gallery @stop
@section('page-description') List all Old Cars Gallery. @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::dealergallery.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add an Old Car</a>
</div>
@stop



@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-12">
        <table class="table border border-1">
            <thead class="thead-light">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Car</th>
                <th scope="col">Image</th>
                <th scope="col">View Order</th>
                <th scope="col" class="text-center w-10">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($carsGallery as $gallery)
                <tr>
                    <th class="align-middle" scope="row">{!! $gallery->id !!}</th>
                    <td class="align-middle">{!! $gallery->getCar->name !!}</td>
                    <td class="align-middle"><img src="{!! url(Storage::url($gallery->media)) !!}" width="150"></td>
                    <td class="align-middle">{!! $gallery->view_order !!}</td>
                    <td class="align-middle text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="{!! route('Ripple::dealergallery.edit', ['id'=>$gallery->id]) !!}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0);" onClick="document.getElementById('delete_car_{{$gallery->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        <form id="delete_car_{{$gallery->id}}" action="{!! route('Ripple::dealergallery.destroy', ['id'=>$gallery->id]) !!}" method="post">@csrf @method('DELETE') </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
    </div>
</div>
@stop