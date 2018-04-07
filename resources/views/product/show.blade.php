@extends('Ripple::layouts.beta-app')
@section('page-title')View Product @stop
@section('pate-description') View details of a product @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::products.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List Products</a>
    <a href="{!! route('Ripple::products.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add New</a>
    <a href="{!! route('Ripple::products.edit', ['id'=>$product->id]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Product</a>
    <a href="javascript:void(0);" onClick="document.getElementById('delete_product_{{$product->id}}').submit();" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Delete Product</a>
    <form id="delete_product_{{$product->id}}" action="{!! route('Ripple::products.destroy', ['id'=>$product->id]) !!}" method="post">@csrf @method('DELETE') </form>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3>{!! $product->title !!}</h3>
                </div>             
                <div class="card-body">
                    <div class="row px-3">
                        <div class="col-md-9 p-0 border border-1">
                            <div class="col-md-12 product-description product-full-description p-3 ">
                                <label for="" class="font-weight-bold">Description</label>
                                <p>
                                {!! $product->description !!}
                                </p>
                            </div>
                            <hr>
                            <div class="col-md-12 product-description product-full-description p-3">
                                <label for="" class="font-weight-bold">Short Description</label>
                                <p>
                                {!! $product->short_description !!}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center p-3 border border-1 align-middle">
                            <img width="220" src="{!! url(Storage::url($product->image)) !!}" alt="{!! $product->title !!}">
                        </div>
                    </div>
                    <div class="row px-3">
                        <div class="col-md-3 p-3 border border-1">
                            <label class="font-weight-bold" for="product">Regular Price</label>
                            <p>
                            ${!! $product->regular_price !!}    
                            </p>
                        </div>
                        <div class="col-md-3 p-3 border border-1">
                            <label class="font-weight-bold" for="product">Sale Price</label>
                            <p>
                            ${!! $product->sale_price !!}    
                            </p>
                        </div>
                        <div class="col-md-3 p-3 border border-1">
                            <label class="font-weight-bold" for="product">Sale Starts</label>
                            <p>
                            {!! date('F d,Y', strtotime($product->sale_end)) !!}
                            </p>
                        </div>
                        <div class="col-md-3 p-3 border border-1">
                            <label class="font-weight-bold" for="product">Sale Ends</label>
                            <p>
                            {!! date('F d,Y', strtotime($product->sale_end)) !!}
                            </p>
                        </div>
                    </div>
                    <div class="row px-3">
                        <div class="col-md-3 p-3 border border-1">
                            <label class="font-weight-bold" for="product">SKU</label>
                            <p>
                            {!! $product->sku !!}    
                            </p>
                        </div>
                        <div class="col-md-3 p-3 border border-1">
                            <label class="font-weight-bold" for="product">In Stock ?</label>
                            <p>
                            @if($product->stock_status == 1) Yes @else No @endif
                            </p>
                        </div>
                        <div class="col-md-3 p-3 border border-1">
                            <label class="font-weight-bold" for="product">Category</label>
                            <p>
                            {!! $product->category !!}
                            </p>
                        </div>
                        <div class="col-md-3 p-3 border border-1">
                            <label class="font-weight-bold" for="product">Tags</label>
                            <p>
                            {!! $product->tags !!}
                            </p>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@stop