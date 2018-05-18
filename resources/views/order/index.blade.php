@extends('Ripple::layouts.beta-app')


@section('page-title') Product Orders @stop
@section('page-description') List all Product Orders. @stop




@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-12">
        <table class="table border border-1">
            <thead class="thead-light">
                <tr>
                <th scope="col">Order ID</th>
                <th scope="col">User</th>
                <th scope="col">Product</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-center w-10">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                @php
                    $product_data = json_decode($order->product_data, true);
                @endphp
                <tr>
                    <td class="align-middle">{!! $order->order_no !!}</td>
                    <td class="align-middle">{!! $order->getUser->email !!}</td>
                    <td class="align-middle">@foreach($product_data as $product) {!!  $product['name'] !!}<br/> @endforeach</td>
                    <td class="align-middle">{!! $order->status !!}</td>
                    <td class="align-middle text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="{!! route('Ripple::order.edit', ['id'=>$order->id]) !!}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0);" onClick="document.getElementById('delete_order_{{$order->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        <form id="delete_order_{{$order->id}}" action="{!! route('Ripple::order.destroy', ['id'=>$order->id]) !!}" method="post">@csrf @method('DELETE') </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
    </div>
</div>
@stop