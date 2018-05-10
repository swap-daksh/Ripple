@extends('Ripple::layouts.beta-app')
@section('page-title') Old Cars @stop
@section('page-description') List all Old Cars. @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::dealer.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add an Old Car</a>
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
                <th scope="col">Maker</th>
                <th scope="col">Car Model</th>
                <th scope="col">Body Type</th>
                <th scope="col">Car Sold</th>
                <th scope="col" class="text-center w-10">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <th class="align-middle" scope="row">{!! $car->id !!}</th>
                    <td class="align-middle">{!! $car->getMaker->maker !!}</td>
                    <td class="align-middle">{!! $car->getSeries->series !!}</td>
                    <td class="align-middle">{!! $car->bodies->body !!}</td>
                    <td class="align-middle">@if($car->sold == 1) Yes @else No @endif</td>
                    <td class="align-middle text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="{!! route('Ripple::dealer.edit', ['id'=>$car->id]) !!}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0);" onClick="document.getElementById('delete_car_{{$car->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        <form id="delete_car_{{$car->id}}" action="{!! route('Ripple::dealer.destroy', ['id'=>$car->id]) !!}" method="post">@csrf @method('DELETE') </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
    </div>
</div>
@stop