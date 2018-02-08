@extends('Ripple::layouts.beta-app') 
@section('page-title') General Settings @stop
@section('page-description') All global settings are listed here @stop
@section('buttons') 
<button class="btn btn-success btn-sm" type="button" onclick="document.getElementById('update-settings').submit();"><i class="fa fa-save"></i> Save Settings</button>
<a href="{!! route('Ripple::settingModule') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Settings</a>
@stop
@section('page-content') 
<div class="container-fluid p-3"> 
    <div class="row">
        <div class="col"> 
            <div class="card rounded-0">
                <div class="card-body clearfix">
                    <div class="row">
                        <div class="col col-md-8">
                            <form id="update-settings" action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="zzz" name="setting-update"> 
                                {!! csrf_field() !!}
                                <div class="" id="accordion">
                                    @forelse($settings as $setting)
                                    <div class="card rounded-0 mb-1">
                                        <div class="card-header rounded-0 p-0" id="{!! $setting->key !!}_heading">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" style="text-decoration: none;" type="button" data-toggle="collapse" data-target="#{!! $loop->index !!}" aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="fa fa-cogs"></i>&nbsp; {!! ucwords(strtolower($setting->display_name)) !!}
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="{!! $loop->index !!}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                @if($setting->type === 'checkbox')
                                                @if($setting->value)
                                                <label>
                                                    <input id="{!! $setting->key.'-'.$loop->index !!}" checked name="{!! $setting->key !!}"  type="checkbox">
                                                    <span></span>
                                                </label>
                                                @else
                                                <label>
                                                    <input id="{!! $setting->key.'-'.$loop->index !!}" name="{!! $setting->key !!}" type="checkbox">
                                                    <span></span>
                                                </label>
                                                @endif
                                                @elseif($setting->type === 'file')
                                                <input  name="{!! $setting->key !!}" type="file">
                                                @elseif($setting->type === 'image')
                                                <div class="col-md-3">
                                                    <div id="data-preview-{!! $setting->key !!}">
                                                        @if($setting->value !== '')
                                                        <img class="img-responsive" src="{!! url(Storage::url($setting->value)) !!}" alt="" width="150" height="100">
                                                        @else
                                                        <img class="img-responsive" src="{!! ripple_asset('/img/default/default.png') !!}" alt="" width="150" height="100">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="file" class="image-preview file-input" id="{!! $setting->key !!}-input" data-preview='data-preview-{!! $setting->key !!}' name="{!! $setting->key !!}" >
                                                </div>
                                                @elseif($setting->type === 'radio')
                                                <p class="items-push">
                                                    @foreach(json_decode($setting->options) as $name=>$value)
                                                    <label class="css-input css-radio css-radio-primary push-10-r" for="{!! $setting->key.'-'.$loop->index !!}">
                                                        @if($setting->value === $value)
                                                        <input id="{!! $setting->key.'-'.$loop->index !!}" checked name="{!! $setting->key !!}" value="{!! $value !!}" type="radio"> 
                                                        @else
                                                        <input id="{!! $setting->key.'-'.$loop->index !!}" name="{!! $setting->key !!}" value="{!! $value !!}" type="radio"> 
                                                        @endif
                                                        <span></span>
                                                        {!! $name !!}
                                                    </label>
                                                    @endforeach
                                                </p>
                                                @elseif($setting->type === 'dropdown')
                                                <select class="form-control" name="{!! $setting->key !!}" placeholder="{!! ucfirst($setting->display_name) !!}">
                                                    @foreach(json_decode($setting->options) as $name=>$value)
                                                    @if($setting->value === $value)
                                                    <option  selected value="{!! $value !!}">{!! ucfirst($name) !!}</option>
                                                    @else
                                                    <option  value="{!! $value !!}">{!! ucfirst($name) !!}</option>
                                                    @endif
                                                    {!! $name !!}
                                                    @endforeach
                                                </select>
                                                @elseif($setting->type === 'textbox')
                                                <input class="form-control" name="{!! $setting->key !!}" placeholder="{!! ucfirst($setting->display_name) !!}" value="{!! $setting->value !!}" type="text">
                                                @elseif($setting->type === 'textarea')
                                                <textarea class="form-control" name="{!! $setting->key !!}" cols="30" rows="5" placeholder="{!! ucfirst($setting->display_name) !!}">{!! $setting->value !!}</textarea>
                                                @elseif($setting->type === 'texteditor')
                                                <textarea class="form-control ripple_text_editor" name="{!! $setting->key !!}" placeholder="{!! ucfirst($setting->display_name) !!}">{!! $setting->value !!}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                                    @empty
                                    <div class="alert alert-danger">
                                        <p><i class="fa fa-warning"></i> Oops! Seems No Settings Available</p>
                                    </div>
                                    @endforelse
                                </div>
                            </form>
                        </div>

                        <div class="col col-md-4">
                            <div class="card rounded-0">
                                <div class="card-header rounded-0">
                                    <i class="fa fa-plus-circle" ></i>   Add New Setting
                                </div>
                                <div class="card-body">
                                    <form method="post" action="" id="add_new_setting">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="setting-create" value="zzz">
                                        <input type="hidden" name="group" value="sco">
                                        <input type="submit" value="&nbsp;" hidden id="create-setting">
                                        <div class="form-group clearfix">
                                            <input class="form-control input-sm setting-key" id="setting-key" required name="setting-key" type="text" placeholder="Setting Key">
                                        </div>
                                        <div class="form-group clearfix">
                                            <input class="form-control input-sm setting-name" id="setting-name" required name="setting-name" type="text" placeholder="Display Name">
                                        </div>
                                        <div class="form-group clearfix">
                                            <select required name="setting-type" id="setting-type" data-id='setting-type' class="form-control input-sm setting-type">
                                                <option>Setting Type</option>
                                                <option value="checkbox">Check Box</option>
                                                <option value="file">File</option>
                                                <option value="image">Image</option>
                                                <option value="radio">Radio</option>
                                                <option value="dropdown">Dropdown</option>
                                                <option value="textbox" selected>Text Box</option>
                                                <option value="textarea">Text Area</option>
                                                <option value="texteditor">Text Editor</option>
                                            </select>
                                        </div>

                                        <div class="block setting-options" id="setting-options" data-id='setting-options' style="display: none;box-shadow: none;">
                                            <div class="block-content clearfix" style="padding-top: 0px;padding-bottom: 0px">
                                                <div class="table-responsive" style="border:1px solid #F9F9F9;">
                                                    <table class="table table-striped table-borderless table-header-bg option-wrappers" id="option-wrappers" style="margin-bottom: 0px;">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Name</th>
                                                                <th>Value</th>
                                                                <th class="text-center">
                                                                    <i class="fa fa-plus add-options text-info" style="cursor: pointer" id="add-options" data-id="add-options"></i>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="option-sorting">
                                                            <tr class="option-group setting-option-group">
                                                                <td class="text-center " style="vertical-align: middle !important;">
                                                                    <i class="fa fa-arrows draggable-handler text-warning"></i>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input  type="text" name="" class="form-control input-sm option-name" data-id='option-name' data-name='option-name'>
                                                                </td>
                                                                <td>
                                                                    <input  type="text" name="" class="form-control input-sm option-value" data-id='option-value' data-name='option-value'>
                                                                </td>
                                                                <td class="text-center" style="vertical-align: middle !important;"><a href="javascript:void(0);" class=" remove-options"><i class="fa fa-trash text-danger"></i></a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-0 clearfix">
                                            <button class="btn btn-block btn-info btn-sm"><i class="fa fa-plus-square"></i>  Add Setting</button>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('page-script')
<script type="text/javascript"> </script>
@endpush