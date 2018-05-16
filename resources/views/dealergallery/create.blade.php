@extends('Ripple::layouts.beta-app')
@section('page-title') Add an Old Car Gallery Image @stop
@section('page-description') Add an old Car Gallery Image @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::dealergallery.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List Old Cars Gallery</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
    <div class="col-md-12">
        <div class="card rounded-0">
                <div class="card-body">
                    <form method="POST" id="AddBreadForm" enctype="multipart/form-data" action="{!! route('Ripple::dealergallery.store') !!}">
                        @csrf
                        <input type="hidden" name="dealer[user_id]" value="{{ Auth::user()->id}}">
                        <div class="form-group">
                            <label for="">Car</label> 
                            <select id="approved_cars_makers" name="gallery[car]"  class="custom-select syncRef">
                                    <option value="">Select Car</option>
                                    @forelse($cars as $car)
                                    <option value="{{ $car->id}}">{{ $car->name}}</option>
                                    @empty
                                    @endforelse                            
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="">IMAGE</label> 
                            <div class="card">
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
                                                        <input class="form-control" placeholder="public/" type="text" name="image_upload_path">
                                                    </div>
                                                </div>
                                                <div class="col-6 mt-3">
                                                    <label for="">Choose Image File</label>
                                                    <div class="custom-file">
                                                        <input class="image-preview custom-file-input-bread" name="gallery_image" id="product_image_custom_input_file" data-preview="preview-image" data-details="#product_image_file_details_info" data-width="auto" data-height="150" type="file">
                                                        <label class="custom-file-label rounded-right" for="product_image_custom_input_file">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div> 
  
                                <div class="form-group">
                                    <label for="">View Order</label> 
                                    <input type="text" name="gallery[view_order]" class="form-control">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button onclick="document.getElementById('AddBreadForm').submit();" class="btn btn-sm btn-success">
                                <i class="fa fa-save"></i>  Save Gallery Image
                            </button> 
                            <a href="{!! route('Ripple::dealergallery.index') !!}" class="btn btn-primary btn-sm">
                                <i class="fa fa-list"></i>  Manage all Gallery Image
                            </a>
                        </div>
        </div>
        </div>
    </div>
</div>
@stop
@push('rp-script-js')


   
    <script type="text/javascript">
        $('#approved_cars_makers').on('change', function(){
                var makerId = $(this).val();
                $.post("{!!route('getSeries') !!}",{id:makerId}, function(data, status){
                    var html ="<option value=''>@lang('global.model')</option>";
                    for(var i in  data) {
                        html +="<option value=\""+i+"\">"+data[i]+"</option>";
                    }
                    $('#approved_cars_series').html(html);
                    
                });
        });
    </script>
    <script type="text/javascript">
        $('#approved_cars_series').on('change', function(){
                var seriesId = $(this).val();
                $.post("{!!route('getModels') !!}",{id:seriesId}, function(data, status){
                    var html ="<option value=''>Select Model</option>";
                    for(var i in  data) {
                        html +="<option value=\""+i+"\">"+data[i]+"</option>";
                    }
                    $('#approved_cars_models').html(html);
                    
                });
        });
    </script>
@endpush