@extends('Ripple::layouts.app')
@section('page-content')
{{-- Page Content --}}
<div class="content">
    <div class="block block-themed">
        <div class="block-header bg-city">
            <ul class="block-options">
                <li>
                    <button data-toggle="modal" data-target="#modal-large" type="button"><i class="si si-settings"></i></button>
                </li>
            </ul>
            <h3 class="block-title">Settings</h3>
        </div>
        <div class="block-content">
            <form class="form-horizontal push-10-t push-10" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value="zzz" name="setting-update"> 
                {!! csrf_field() !!}
                @foreach($settings as $setting)
                <div class="form-group">
                    <label class="col-xs-12" for="login1-password">{!! strtoupper($setting->display_name) !!}</label>
                    <div class="col-xs-12">
                        @if($setting->type === 'checkbox')
                        @if($setting->value)
                        <label class="css-input switch switch-square switch-sm switch-primary">
                            <input id="{!! $setting->key.'-'.$loop->index !!}" checked name="{!! $setting->key !!}"  type="checkbox">
                            <span></span>
                        </label>

                        @else
                        <label class="css-input switch switch-square switch-sm switch-primary">
                            <input id="{!! $setting->key.'-'.$loop->index !!}" name="{!! $setting->key !!}" type="checkbox">
                            <span></span>
                        </label>
                        @endif
                        @elseif($setting->type === 'file')
                        <input  name="{!! $setting->key !!}" type="file">
                        @elseif($setting->type === 'image')
                        <div class="animated fadeIn col-md-3 no-padding">
                            <div class="img-container">
                                <div id="data-preview-{!! $setting->key !!}">
                                    @if(!is_null($setting->value))
                                    <img class="img-responsive" src="{!! url(Storage::url($setting->value)) !!}" alt="" width="150" height="100">
                                    @else
                                    <img class="img-responsive" src="{!! ripple_asset('/img/default/default.png') !!}" alt="" width="150" height="100">
                                    @endif
                                </div>
                                <div class="img-options">
                                    <div class="img-options-content">
                                        <h3 class="font-w400 text-white push-5">{!! strtoupper($setting->display_name) !!}</h3>
                                        <h4 class="h6 font-w400 text-white-op push-15"></h4>
                                        <label class="btn btn-sm btn-default" for="{!! $setting->key !!}-input"><i class="fa fa-pencil"></i> Change</label>
                                        <input type="file" class="image-preview file-input" id="{!! $setting->key !!}-input" data-preview='data-preview-{!! $setting->key !!}' name="{!! $setting->key !!}" style="display: none">
                                        <a class="btn btn-sm btn-default" href="javascript:void(0)"><i class="fa fa-times"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
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
                    <div class="col-md-12"><hr style="margin-bottom: 0px;"></div>
                </div>
                @endforeach
                <div class="form-group">
                    <div class="col-xs-12">
                        <button class="btn btn-minw btn-square btn-primary btn-block" type="submit"><i class="fa fa-cloud-upload"></i> Update Settings</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Add New Settings</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <form method="post" action="" id="add_new_setting">
                            {!! csrf_field() !!}
                            <input type="hidden" name="setting-create" value="zzz">
                            <input type="submit" value="&nbsp;" hidden id="create-setting">
                            <div class="col-md-4">
                                <div class="form-group clearfix">
                                    <label>Setting Key</label>
                                    <input class="form-control setting-key" id="setting-key" required name="setting-key" type="text">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group clearfix">
                                    <label>Setting Name</label>
                                    <input class="form-control setting-name" id="setting-name" required name="setting-name" type="text">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group clearfix">
                                    <label>Setting Type</label>
                                    <select required name="setting-type" id="setting-type" data-id='setting-type' class="form-control setting-type">
                                        <option>Select setting type</option>
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
                            </div>

                            <div class="block setting-options" id="setting-options" data-id='setting-options' style="display: none;box-shadow: none;">
                                <div class="block-header">
                                    <ul class="block-options">
                                        <li>
                                            <button id="add-options" class="add-options" data-id="add-options" type="button"><i class="fa fa-plus"></i> Add New</button>
                                        </li>
                                    </ul>
                                    <h3 class="block-title">Options</h3>
                                </div>
                                <div class="block-content clearfix" style="padding-top: 0px;padding-bottom: 0px">
                                    <div class="table-responsive" style="border:1px solid #F9F9F9;">
                                        <table class="table table-striped table-borderless table-header-bg option-wrappers" id="option-wrappers" style="margin-bottom: 0px;">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Value</th>
                                                    <th class="text-center"><i class="fa fa-bolt"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody id="option-sorting">
                                                <tr class="option-group setting-option-group">
                                                    <td class="text-center " style="vertical-align: middle !important;">
                                                        <i class="fa fa-arrows draggable-handler"></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <input  type="text" name="" class="form-control option-name" data-id='option-name' data-name='option-name'>
                                                    </td>
                                                    <td>
                                                        <input  type="text" name="" class="form-control option-value" data-id='option-value' data-name='option-value'>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle !important;"><a href="javascript:void(0);" class=" remove-options"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal" onclick="document.getElementById('add_new_setting').reset();">Close</button>
                <button class="btn btn-sm btn-primary" type="button" onclick="document.getElementById('create-setting').click();"><i class="fa fa-check"></i> Save Setting</button>
            </div>
        </div>
    </div>
</div>
{{-- END Page Content --}}
@stop
