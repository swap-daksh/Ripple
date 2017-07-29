@extends('Ripple::layouts.app')
@section('page-content')
{{-- Page Header --}}
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Settings <small>Website Settings</small><button class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-ripple-setting">
        <i class="fa fa-cog"></i> Add Setting
    </button>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a class="link-effect"href="{!! route('Ripple::dashboard') !!}"><i class="fa fa-icon"></i> Dashboard</a></li>
                <li>Settings</li>
            </ol>
        </div>
    </div>
</div>
{{-- END Page Header --}}
{{-- Page Content --}}
<div class="content">
    <form method="post" action="" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" value="zzz" name="setting-update"> 
        @foreach($settings as $setting)
        @if($setting->type === 'image')
        <div class="block">
            <div class="block-header">
                <ul class="block-options">
                    <li>
                        <button type="button"><i class="si si-settings"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">{!! strtoupper($setting->display_name) !!}</h3>
            </div>
            <div class="block-content clearfix">
                <div class="animated fadeIn col-md-3" style="margin-bottom: 15px">
                    <div class="img-container">
                        <div id="data-preview-{!! $setting->key !!}">
                            @if($setting->value !== '')
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
            </div>
        </div>
        @elseif($setting->type === 'file')
        <div class="block">
            <div class="block-header">
                <ul class="block-options">
                    <li>
                        <button type="button"><i class="si si-settings"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">{!! strtoupper($setting->display_name) !!}</h3>
            </div>
            <div class="block-content">
                <p>
                    <input  name="{!! $setting->key !!}" type="file">
                </p>
            </div>
        </div>
        @elseif($setting->type === 'text_area')
        <div class="block">
            <div class="block-header">
                <ul class="block-options">
                    <li>
                        <button type="button"><i class="si si-settings"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">{!! strtoupper($setting->display_name) !!}</h3>
            </div>
            <div class="block-content">
                <p>
                    <textarea rows="5" name="{!! $setting->key !!}" class="form-control">{!! $setting->value !!}</textarea>
                </p>
            </div>
        </div>
        @elseif($setting->type === 'select_dropdown')
        <div class="block">
            <div class="block-header">
                <ul class="block-options">
                    <li>
                        <button type="button"><i class="si si-settings"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">{!! strtoupper($setting->display_name) !!}</h3>
            </div>
            <div class="block-content">
                <p>
                    <select name="{!! $setting->key !!}" class="form-control">
                        @foreach(json_decode($setting->options) as $name=>$value)
                        @if($setting->value === $value)
                        <option  selected value="{!! $value !!}">{!! ucfirst($name) !!}</option>
                        @else
                        <option  value="{!! $value !!}">{!! ucfirst($name) !!}</option>
                        @endif
                        {!! $name !!}
                        @endforeach
                    </select>

                </p>
            </div>
        </div>
        @elseif($setting->type === "text_editor")
        <div class="block">
            <div class="block-header">
                <ul class="block-options">
                    <li>
                        <button type="button"><i class="si si-settings"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">{!! strtoupper($setting->display_name) !!}</h3>
            </div>
            <div class="block-content">
                <p>
                    <textarea rows="5" name="{!! $setting->key !!}" class="form-control ripple_text_editor">{!! $setting->value !!}</textarea>
                </p>
            </div>
        </div>
        @elseif($setting->type === 'check_box')
        <div class="block">
            <div class="block-header">
                <ul class="block-options">
                    <li>
                        <button type="button"><i class="si si-settings"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">{!! strtoupper($setting->display_name) !!}</h3>
            </div>
            <div class="block-content">
                <p>
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
                </p>
            </div>
        </div>
        @elseif($setting->type === "radio_btn")
        <div class="block">
            <div class="block-header">
                <ul class="block-options">
                    <li>
                        <button type="button"><i class="si si-settings"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">{!! strtoupper($setting->display_name) !!}</h3>
            </div>
            <div class="block-content">
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
            </div>
        </div>
        @else
        <div class="block">
            <div class="block-header">
                <ul class="block-options">
                    <li>
                        <button type="button"><i class="si si-settings"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">{!! strtoupper($setting->display_name) !!}</h3>
            </div>
            <div class="block-content">
                <p>
                <div class="form-material">
                    <input class="form-control" name="{!! $setting->key !!}" placeholder="Enter your username.." value="{!! $setting->value !!}" type="text">
                </div>
                </p>
            </div>
        </div>
        @endif
        @endforeach
        <div class="block">
            <div class="block-content">
                <p class="text-center">
                    <a class="btn btn-minw btn-square btn-primary" href='{!! route("Ripple::adminSettings") !!}'><i class="fa fa-plus"></i> Add Setting</a>
                    <button class="btn btn-minw btn-square btn-primary" type="submit"><i class="fa fa-cloud-upload"></i> Update Settings</button>
                </p>
            </div>
        </div>
    </form>
</div>
{{-- END Page Content --}}





























<div id="add-ripple-setting" class="modal animated fadeIn" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4><i class="fa fa-cog fa-spin fa-fw"></i> Add New Setting</h4>
            </div>
            <div class="modal-body clearfix">
                <form method="post" action="" id="add_new_setting">
                    {!! csrf_field() !!}
                    <input type="hidden" name="setting-create" value="zzz">
                    <div class="col-md-4">
                        <div class="form-group clearfix">
                            <div class="col-md-12 no-padding">
                                <label><i class="fa fa-key"></i> Key</label>
                                <input type="text" class="form-control setting-key" id="setting-key" data-id="setting-key" name="setting-key" value="" placeholder='"site_title", "site-title"'>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group clearfix">
                            <div class="col-md-12 no-padding">
                                <label><i class="fa fa-hashtag"></i> Name</label>
                                <input type="text" class="form-control setting-name" name="setting-name" data-id='setting-name' id="setting-name" value="" placeholder="Site Title">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group clearfix">
                            <div class="col-md-12 no-padding">
                                <label><i class="fa fa-list"></i> Type</label>
                                <select name="setting-type" id="setting-type" data-id='setting-type' class="form-control setting-type">
                                    <option value="check_box">Check Box</option>
                                    <option value="file">File</option>
                                    <option value="image">Image</option>
                                    <option value="radio_btn">Radio Button</option>
                                    <option value="select_dropdown">Select Dropdown</option>
                                    <option value="text_box" selected>Text Box</option>
                                    <option value="text_area">Text Area</option>
                                    <option value="text_editor">Text Editor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 setting-options no-padding" id="setting-options" data-id='setting-options' style="display: none">
                        <hr>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                            <div class="col-md-6 col-sm-6 col-xs-6"><label>Name <i class="fa fa-angle-double-down"></i></label></div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><label>Value <i class="fa fa-angle-double-down"></i></label></div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 option-wrappers no-padding" id="option-wrappers">
                            <div class="form-group option-group setting-option-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input  type="text" name="" class="form-control option-name" data-id='option-name' data-name='option-name'>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input  type="text" name="" class="form-control option-value" data-id='option-value' data-name='option-value'>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 no-padding text-center clearfix option-btn-group setting-option-btn-group">
                            <button type="button" class="btn btn-success btn-xs add-options" data-id='add-options' id="add-options"><i class="fa fa-plus"></i> Add Option</button>
                            <button type="button" class="btn btn-danger btn-xs remove-options" id="remove-options" data-id='remove-options'><i class="fa fa-trash"></i> Delete Option</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success save_setting_btn" data-id="save_setting_btn" id="save_setting_btn">Save Setting</button>
            </div>
        </div>
    </div>
</div>




<div id="delete-ripple-setting" class="modal animated fadeIn" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4><i class="fa fa-cog fa-spin fa-fw"></i> Add New Setting</h4>
            </div>
            <div class="modal-body clearfix">
                <form method="post" action="" id="delete_setting">
                    {!! csrf_field() !!}
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success save_setting_btn" data-id="save_setting_btn" id="save_setting_btn">Save Setting</button>
            </div>
        </div>
    </div>
</div>



@stop
@section('unused Content')
<div class="sticky-form-wrapper">
    <div class="sticky-btn-group">
        <div class="sticky-btn">
            <button class="btn btn-primary" id="new-ripple-setting"><i class="fa fa-plus"></i> <span>Add Setting</span></button>
        </div>
        <div class="sticky-btn-close">
            <button data-button="close-form-wrapper" class="btn btn-primary" id="close-form-wrapper"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <div class="sticky-form-body">
        <form action="{!! route('Ripple::adminSettings') !!}" method="post" class="">
            {!! csrf_field() !!}
            <h4 class="text-center">Add New Setting</h4>
            <div class="form-group">
                <label class="" for="setting-name">Setting Name</label>
                <input id="setting-name" name="setting-name" class="form-control " type="text">
            </div>
            <div class="form-group">
                <label class="" for="setting-value">Setting Key</label>
                <input id="setting-value" name="setting-key" class="form-control " type="text">
            </div>
            <div class="form-group">
                <label class="" for="setting-type">Setting Type</label>
                <select name="setting-type" id="setting-type" class="form-control">
                    <option value="text">Text Box</option>
                    <option value="text_area">Text Area</option>
                    <option value="rich_text_box">Rich Textbox</option>
                    <option value="checkbox">Check Box</option>
                    <option value="radio_btn">Radio Button</option>
                    <option value="select_dropdown">Select Dropdown</option>
                    <option value="file">File</option>
                    <option value="image">Image</option>
                </select>
            </div>
            <div class="form-group form-actions">
                <input class="btn btn-success" value="Save changes" type="submit">
            </div>
        </form>
    </div>
</div>
@stop