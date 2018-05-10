@extends('Ripple::layouts.beta-app')
@section('page-title') Add an Old Car @stop
@section('page-description') Add an old Car @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::dealer.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List Old Cars</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
    <div class="col-md-12">
        <div class="card rounded-0">
                <div class="card-body">
                    <form method="POST" id="AddBreadForm" enctype="multipart/form-data" action="{!! route('Ripple::dealer.update', ['id'=>$car->id]) !!}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="dealer[user_id]" value="{{ Auth::user()->id}}">
                        <div class="form-group">
                            <label for="">MAKER</label> 
                            <select id="approved_cars_makers" name="dealer[maker]" data-dealer="Maker" data-sync="1" data-target="approved_cars_series" class="custom-select syncRef">
                                    <option value="">Select Maker</option>
                                    @forelse($makers as $maker)
                                    <option value="{{ $maker->id}}" {!! $car->maker == $maker->id ? 'selected' : '' !!}>{{ $maker->maker}}</option>
                                    @empty
                                    @endforelse                            
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="">SERIES</label> 
                             <select id="approved_cars_series" name="dealer[series]" data-dealer="Series" data-sync="1" data-target="approved_cars_models" class="custom-select syncRef">
                                 <option value="">Select Series</option>
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="">MODEL</label> 
                                <select id="approved_cars_models" data-dealer="Model" name="dealer[model]" class="custom-select">
                                    <option value="">Select Model</option>
                                </select></div> 
                                <div class="form-group">
                                    <label for="">BODY</label>
                                    <select id="approved_cars_bodies" data-dealer="Body" name="dealer[body]" class="custom-select">
                                        <option value="">Select Body</option> 
                                        @forelse($bodies as $body)
                                        <option value="{{ $body->id}}" {!! $car->body == $body->id ? 'selected' : '' !!} >{{ $body->body}}</option>
                                        @empty
                                        @endforelse 
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="">NAME</label> 
                                    <input type="text" name="dealer[name]" value="{!! $car->name !!}" class="form-control">
                                </div> 
                                <div class="form-group">
                                    <label for="">IMAGE</label> 
                                    <div class="card">
                                        <div class="card-body p-3">
                                                <div class="row">
                                                        <div class="col-5">
                                                            <div class="clearfix" id="preview-image"> 
                                                                <img width="auto" height="150" class="img-responsive" src="{!! url(Storage::url($car->image)) !!}" alt="">
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
                                                                <input class="image-preview custom-file-input-bread" name="dealer[image]" id="product_image_custom_input_file" data-preview="preview-image" data-details="#product_image_file_details_info" data-width="auto" data-height="150" type="file">
                                                                <label class="custom-file-label rounded-right" for="product_image_custom_input_file">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="">Sold</label> 
                                        <div class="custom-control custom-checkbox">
                                            <input type="hidden" value="0" name="dealer[sold]"> 
                                            <input type="checkbox" name="dealer[sold]" value="1" id="sold_custom_checkbox" class="custom-control-input" {!! $car->sold == 1 ? 'checked':'unchecked' !!} > 
                                            <label for="sold_custom_checkbox" class="custom-control-label">Check/Uncheck</label>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="">COLOR</label> 
                                        <input type="text" name="dealer[color]" value="{!! $car->color !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">VIDEO</label> 
                                        <input type="text" name="dealer[video]" value="{!! $car->video !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">BASE PRICE</label> 
                                        <input type="text" name="dealer[base_price]" value="{!! $car->base_price !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">MID PRICE</label> 
                                        <input type="text" name="dealer[mid_price]" value="{!! $car->mid_price !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">TOP PRICE</label> 
                                        <input type="text" name="dealer[top_price]" value="{!! $car->top_price !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">WARRANTY</label> 
                                        <input type="text" name="dealer[warranty]" value="{!! $car->warranty !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">ACCELERATION</label> 
                                        <input type="text" name="dealer[acceleration]" value="{!! $car->acceleration !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">SPEED</label> 
                                        <input type="text" name="dealer[speed]" value="{!! $car->speed !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">ENGINE</label> 
                                        <input type="text" name="dealer[engine]" value="{!! $car->engine !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">HORSEPOWER</label> 
                                        <input type="text" name="dealer[horsepower]" value="{!! $car->horsepower !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">CYLINDERS</label>
                                        <input type="text" name="dealer[cylinders]" value="{!! $car->cylinders !!}" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="">SPECIAL FEATURE</label> 
                                        <input type="text" name="dealer[special_feature]" value="{!! $car->special_feature !!}" class="form-control">
                                    </div>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button onclick="document.getElementById('AddBreadForm').submit();" class="btn btn-sm btn-success">
                                <i class="fa fa-save"></i>  Save Old Car
                            </button> 
                            <a href="{!! route('Ripple::dealer.index') !!}" class="btn btn-primary btn-sm">
                                <i class="fa fa-list"></i>  Manage all Old Cars
                            </a>
                        </div>
        </div>
        </div>
    </div>
</div>
@stop
@push('rp-script-js')


    <script type="text/javascript">
    @if(!empty($car->maker) )
    $(document).ready(function(){
        var makerId = {{$car->maker}} ;
        var seriesId = {{$car->series}} ;
        
                $.post("{!!route('getSeries') !!}",{id:makerId}, function(data, status){
                    var html ="<option value=''>@lang('global.model')</option>";
                    for(var i in  data) {
                        if( i == seriesId){
                            html +="<option value=\""+i+"\" selected>"+data[i]+"</option>";
                        } else{
                            html +="<option value=\""+i+"\">"+data[i]+"</option>";
                        }
                    }
                    $('#approved_cars_series').html(html);
                    
                }); 
    });

    @endif
    @if(!empty($car->series) )
    $(document).ready(function(){
        var seriesId = {{$car->series}} ;
        var modelId = {{$car->model}} ;
        $.post("{!!route('getModels') !!}",{id:seriesId}, function(data, status){
                    var html ="<option value=''>Select Model</option>";
                    for(var i in  data) {
                        if( i == modelId){
                            html +="<option value=\""+i+"\" selected>"+data[i]+"</option>";
                        } else{
                            html +="<option value=\""+i+"\">"+data[i]+"</option>";
                        }
                        

                    }
                    $('#approved_cars_models').html(html);
                    
                });
    });

    @endif
    </script>
   
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