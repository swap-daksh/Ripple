@extends('Ripple::layouts.beta-app')
@section('page-title') Products @stop
@section('page-description') List all products. @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::products.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Product</a>
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
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Regular Price</th>
                <th scope="col">Sale Price</th>
                <th scope="col">SKU</th>
                <th scope="col">In Stock</th>
                <th scope="col" class="text-center w-10">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->index + 1}}</th>
                    <td class="align-middle">{!! $product->title !!}</td>
                    <td class="align-middle"><img src="{{ url(Storage::url($product->image))}}" width="50" alt=""></td>
                    <td class="align-middle">{{$product->regular_price}}</td>
                    <td class="align-middle">{{$product->sale_price}}</td>
                    <td class="align-middle">{{$product->sku}}</td>
                    <td class="align-middle">@if($product->stock_status == 1) <label class="badge badge-success">in stock</label> @else <label class="badge badge-danger">out of stock</label> @endif</td>
                    <td class="align-middle text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="{!! route('Ripple::products.edit', ['id'=>$product->id]) !!}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{!! route('Ripple::products.show', ['id'=>$product->id]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            <a href="javascript:void(0);" onClick="document.getElementById('delete_product_{{$product->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        <form id="delete_product_{{$product->id}}" action="{!! route('Ripple::products.destroy', ['id'=>$product->id]) !!}" method="post">@csrf @method('DELETE') </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
    </div>
</div>
@stop