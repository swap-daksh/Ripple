@extends('Ripple::layouts.beta-app')
@section('page-title') Create New Product @stop
@section('page-description') Add a new product to the invertory @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::products.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List Products</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
    <div class="col-md-12">
        <div class="card rounded-0">
            <div class="card-body">
                          <form class="needs-validation" enctype="multipart/form-data" novalidate="" method="post" action="{!! route('Ripple::products.store') !!}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="firstName">Product Title</label>
                                            <input class="form-control" id="firstName" placeholder="" name="product[title]" value="" required="" type="text">
                                            <div class="invalid-feedback">
                                            Valid first name is required.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firstName">Product Description</label>
                                            <textarea class="ripple_text_editor" rows="12" name="product[description]"></textarea>
                                            <div class="invalid-feedback">
                                            Valid first name is required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                            <div class="card rounded-0">
                                                <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="clearfix" id="preview-image"> 
                                                                <img width="auto" height="150" class="img-responsive" src="{!! ripple_asset('/img/default/default.png') !!}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div id="product_image_file_details_info" class="detail_info w-100 px-2">
                                                                <p><strong>Title:</strong>&nbsp;&nbsp;<code>______.___</code></p>
                                                                <p><strong>Size:</strong>&nbsp;&nbsp;<code>___.__ KB/MB</code></p>
                                                                <p><strong>Type:</strong>&nbsp;&nbsp;<code>_____/____</code></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 mt-3">
                                                            <label for="">Upload Directory <sup class="text-danger">Optional</sup></label>
                                                            <div class="input-group  mb-2 mr-sm-2">
                                                                <div class="input-group-prepend" data-toggle="tooltip" title="Specify your path under public directory.">
                                                                    <div class="input-group-text"><i class="far fa-folder-open "></i></div>
                                                                </div>
                                                                <input class="form-control" placeholder="public/" type="text" name="product_image_upload_path">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 mt-3">
                                                            <label for="">Choose Image File</label>
                                                            <div class="custom-file">
                                                                <input class="image-preview custom-file-input-bread" name="product_image" id="product_image_custom_input_file" data-preview="preview-image" data-details="#product_image_file_details_info" data-width="auto" data-height="150" type="file">
                                                                <label class="custom-file-label rounded-right" for="product_image_custom_input_file">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card rounded-0 mt-3">
                                                <div class="card-body row">
                                                    <div class="form-group col-6">
                                                        <label>Regular Price</label>
                                                        <input type="text" class="form-control" name="product[regular_price]" value="00:00">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Sale Price</label>
                                                        <input type="text" class="form-control" name="product[sale_price]" value="00:00">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Sale Start</label>
                                                        <input type="date" class="form-control" name="product[sale_start]">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Sale End</label>
                                                        <input type="date" class="form-control" name="product[sale_end]">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                    <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Product SKU</label>
                                                    <input type="text" class="form-control" name="product[sku]">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Product In Stock ?</label>
                                                    <select id="" class="custom-select" name="product[stock_status]">
                                                        <option value="1">In Stock</option>
                                                        <option value="0">Out of Stock</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Product Categories</label>
                                                    <input type="text" class="form-control" name="product[category]">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Product Tags</label>
                                                    <input type="text" class="form-control" name="product[tags]">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-sm btn-primary">Publish</button>
                                    </div>
                                
                        </form>
            </div>
        </div>
        </div>
    </div>
</div>
@stop