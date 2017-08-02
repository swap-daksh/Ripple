@extends('Ripple::layouts.app')
@section('page-content')
{{-- Page Header --}}
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Settings <small>Website Settings</small>
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
                    <a class="btn btn-minw btn-square btn-primary" href='{!! route("Ripple::adminCreateSetting") !!}'><i class="fa fa-plus"></i> Add Setting</a>
                    @if(count($settings) > 0)
                    <button class="btn btn-minw btn-square btn-primary" type="submit"><i class="fa fa-cloud-upload"></i> Update Settings</button>
                    @endif
                </p>
            </div>
        </div>
    </form>
</div>
{{-- END Page Content --}}
@stop
