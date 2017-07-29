@extends('Ripple::layouts.app')
@section('page-content')
<h3 class="page-header page-header-top">
    <i class="fa fa-cog"></i> 
    Settings <small>An example page with questions and answers</small> 
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-ripple-setting">
        <i class="fa fa-cog"></i> Add Setting
    </button>
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid no-padding">
            <div class="alert alert-info">
                <strong>How To Use:</strong>
                <p>You can get the value of each setting anywhere on your site by calling <code>Ripple::setting('key')</code></p>
            </div>
        </div>
        
        
        
        
        <form method="post" action="" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" value="zzz" name="setting-update"> 
            @foreach($settings as $setting)
            @if($setting->type === 'image')
            <div class="form-group clearfix  setting-wrapper">
                <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                    <label class="col-xs-12 col-sm-12 col-md-12 setting-label">
                        {!! strtoupper($setting->display_name) !!} <code>Ripple::setting('{!! $setting->key !!}')</code>
                        <div class="pull-right">                            <img src="{!! ripple_asset('/img/loader.svg') !!}" width="25" height="25">
                            <i class="fa fa-trash setting-trash"  data-id="{!! $setting->id !!}" data-key="{!! $setting->key !!}" data-name="{!! $setting->display_name !!}"></i>
                        </div>
                    </label>
                    <div id="{!! $setting->key !!}">
                        @if($setting->value !== '')
                        <img class="img-thumbnail" src="{!! url(Storage::url($setting->value)) !!}" width="120" height="120">
                        @else
                        <img class="img-thumbnail" src="{!! url('img/placeholders/image_dark_120x120.png') !!}" width="120" height="120">
                        @endif

                    </div>
                    <input type="file" class="image-preview file-input" data-preview='{!! $setting->key !!}' name="{!! $setting->key !!}">
                </div>
            </div>
            @elseif($setting->type === 'file')
            <div class="form-group clearfix  setting-wrapper">
                <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                    <label class="col-xs-12 col-sm-12 col-md-12 setting-label">
                        {!! strtoupper($setting->display_name) !!} 
                        <code>Ripple::setting('{!! $setting->key !!}')</code>
                        <div class="pull-right">                            <img src="{!! ripple_asset('/img/loader.svg') !!}" width="25" height="25">
                            <i class="fa fa-trash setting-trash"  data-id="{!! $setting->id !!}" data-key="{!! $setting->key !!}" data-name="{!! $setting->display_name !!}"></i>
                        </div>
                    </label>
                    <input type="text" class="form-control" value="{!! $setting->value !!}">
                    
                </div>
            </div>
            @elseif($setting->type === 'text_area')
            <div class="form-group clearfix  setting-wrapper">
                <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                    <label class="col-xs-12 col-sm-12 col-md-12 setting-label">
                        {!! strtoupper($setting->display_name) !!} 
                        <code>Ripple::setting('{!! $setting->key !!}')</code>
                        <div class="pull-right">                            <img src="{!! ripple_asset('/img/loader.svg') !!}" width="25" height="25">
                            <i class="fa fa-trash setting-trash"  data-id="{!! $setting->id !!}" data-key="{!! $setting->key !!}" data-name="{!! $setting->display_name !!}"></i>
                        </div>
                    </label>
                    <textarea rows="5" name="{!! $setting->key !!}" class="form-control">{!! $setting->value !!}</textarea>
                    
                </div>
            </div>
            @elseif($setting->type === 'select_dropdown')
            <div class="form-group clearfix  setting-wrapper">
                <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                    <label class="col-xs-12 col-sm-12 col-md-12 setting-label">
                        {!! strtoupper($setting->display_name) !!} 
                        <code>Ripple::setting('{!! $setting->key !!}')</code>
                        <div class="pull-right">                            <img src="{!! ripple_asset('/img/loader.svg') !!}" width="25" height="25">
                            <i class="fa fa-trash setting-trash"  data-id="{!! $setting->id !!}" data-key="{!! $setting->key !!}" data-name="{!! $setting->display_name !!}"></i>
                        </div>
                    </label>
                    <select name="{!! $setting->key !!}" class="form-control">
                        <option value="">Select {!! ucfirst($setting->display_name) !!}</option>
                        @foreach(json_decode($setting->options) as $option)
                        <option value="{!! $option->value !!}">{!! $option->name !!}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            @elseif($setting->type === "text_editor")
            <div class="form-group clearfix  setting-wrapper">
                <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                    <label class="col-xs-12 col-sm-12 col-md-12 setting-label">
                        {!! strtoupper($setting->display_name) !!} 
                        <code>Ripple::setting('{!! $setting->key !!}')</code>
                        <div class="pull-right">                            <img src="{!! ripple_asset('/img/loader.svg') !!}" width="25" height="25">
                            <i class="fa fa-trash setting-trash"  data-id="{!! $setting->id !!}" data-key="{!! $setting->key !!}" data-name="{!! $setting->display_name !!}"></i>
                        </div>
                    </label>
                    <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                        <textarea rows="5" name="{!! $setting->key !!}" class="form-control ripple_text_editor">{!! $setting->value !!}</textarea>
                    </div>
                    
                    
                </div>
            </div>
            @elseif($setting->type === 'check_box')
            <div class="form-group clearfix  setting-wrapper">
                <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                    <label class="col-xs-12 col-sm-12 col-md-12 setting-label">
                        {!! strtoupper($setting->display_name) !!} 
                        <code>Ripple::setting('{!! $setting->key !!}')</code>
                        <div class="pull-right">
                            <img src="{!! ripple_asset('/img/loader.svg') !!}" width="25" height="25">
                            <i class="fa fa-trash setting-trash"  data-id="{!! $setting->id !!}" data-key="{!! $setting->key !!}" data-name="{!! $setting->display_name !!}"></i>
                        </div>
                    </label>
                    <div class="col-md-12">
                        @foreach(json_decode($setting->options) as $name=>$value)
                        <label class="checkbox-inline" for="{!! $setting->key.'-'.$loop->index !!}">
                            @if($setting->value === $value)
                            <input id="{!! $setting->key.'-'.$loop->index !!}" checked name="{!! $setting->key !!}" value="{!! $value !!}" type="checkbox"> {!! $name !!}
                            @else
                            <input id="{!! $setting->key.'-'.$loop->index !!}" name="{!! $setting->key !!}" value="{!! $value !!}" type="checkbox"> {!! $name !!}
                            @endif
                        </label>
                        @endforeach
                    </div>
                    
                </div>
            </div>
            @elseif($setting->type === "radio_btn")
            <div class="form-group clearfix  setting-wrapper">
                <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                    <label class="col-xs-12 col-sm-12 col-md-12 setting-label">
                        {!! strtoupper($setting->display_name) !!} 
                        <code>Ripple::setting('{!! $setting->key !!}')</code>
                        <div class="pull-right">                            <img src="{!! ripple_asset('/img/loader.svg') !!}" width="25" height="25">
                            <i class="fa fa-trash setting-trash"  data-id="{!! $setting->id !!}" data-key="{!! $setting->key !!}" data-name="{!! $setting->display_name !!}"></i>
                        </div>
                    </label>
                    <!--<input type="text" name="{!! $setting->key !!}" class="form-control" value="{!! $setting->value !!}">-->
                    <div class="col-md-12">
                        @foreach(json_decode($setting->options) as $name=>$value)
                        <label class="radio-inline" for="{!! $setting->key.'-'.$loop->index !!}">
                            @if($setting->value === $value)
                            <input id="{!! $setting->key.'-'.$loop->index !!}" checked name="{!! $setting->key !!}" value="{!! $value !!}" type="radio"> {!! $name !!}
                            @else
                            <input id="{!! $setting->key.'-'.$loop->index !!}" name="{!! $setting->key !!}" value="{!! $value !!}" type="radio"> {!! $name !!}
                            @endif
                        </label>
                        @endforeach 
                    </div>
                </div>
            </div>
            @else
            <div class="form-group clearfix setting-wrapper">
                <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
                    <label class="col-xs-12 col-sm-12 col-md-12 setting-label">
                        {!! strtoupper($setting->display_name) !!} 
                        <code>Ripple::setting('{!! $setting->key !!}')</code>
                        <div class="pull-right">                            <img src="{!! ripple_asset('/img/loader.svg') !!}" width="25" height="25">
                            <i class="fa fa-trash setting-trash"  data-id="{!! $setting->id !!}" data-key="{!! $setting->key !!}" data-name="{!! $setting->display_name !!}"></i>
                        </div>
                    </label>
                    <input type="text" name="{!! $setting->key !!}" class="form-control" value="{!! $setting->value !!}">
                </div>
            </div>
            @endif

            @endforeach
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Update Setting</button>
                </div>
            </div>
        </form> 
    </div>
</div>



















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