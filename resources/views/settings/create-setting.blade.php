@extends('Ripple::layouts.app')
@section('page-content')
{{-- Page Header --}}
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Settings <small>Add New</small>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a class="link-effect"href="{!! route('Ripple::dashboard') !!}"><i class="fa fa-icon"></i> Dashboard</a></li>
                <li><a class="link-effect"href="{!! route('Ripple::adminSettings') !!}"><i class="fa fa-icon"></i> Settings</a></li>
                <li>Create</li>
            </ol>
        </div>
    </div>
</div>
{{-- END Page Header --}}
{{-- Page Content --}}
<div class="content">
    {{-- My Block --}}
    <form method="post" action="" id="add_new_setting">
        {!! csrf_field() !!}
        <input type="hidden" name="setting-create" value="zzz">
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
                <h3 class="block-title"></h3>
            </div>
            <div class="block-content clearfix">
                <div class="col-md-6">
                    <div class="form-material floating">
                        <input class="form-control setting-key" id="setting-key" name="setting-key" type="text">
                        <label for="login3-username"><i class="fa fa-key"></i> Key</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-material floating">
                        <input class="form-control setting-name" id="setting-name" name="setting-name" type="text">
                        <label for="login3-username"><i class="fa fa-hash-tag"></i> Setting Name</label>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 15px">
                    <div class="form-group clearfix">
                        <select name="setting-type" id="setting-type" data-id='setting-type' class="form-control setting-type">
                            <option>Select setting type</option>
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
        </div>

        <div class="block setting-options" id="setting-options" data-id='setting-options' style="display: none">
            <div class="block-header">
                <h3 class="block-title">Options</h3>
            </div>
            <div class="block-content clearfix">
                <div class="table-responsive">
                    <table class="table table-bordered table-vcenter option-wrappers" id="option-wrappers">
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
                                <td class="text-center ">
                                    <i class="fa fa-arrows draggable-handler"></i>
                                </td>
                                <td class="text-center">
                                    <div class="form-material input-group">
                                        <input  type="text" name="" class="form-control option-name" data-id='option-name' data-name='option-name'>
                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-material input-group">
                                        <input  type="text" name="" class="form-control option-value" data-id='option-value' data-name='option-value'>
                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                    </div>
                                </td>
                                <td class="text-center"><a href="javascript:void(0);" class="btn btn-danger remove-options"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 text-center" style="margin-bottom: 15px">
                    <a href="javascript:void(0);" class="btn btn-primary add-options" data-id='add-options' id="add-options"><i class="fa fa-plus"></i> Add New Option</a>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-content">
                <p class="text-center"><button style="submit" class="btn btn-primary">Save Setting</button></p>
            </div>
        </div>
    </form>



    {{-- END My Block --}}
</div>
{{-- END Page Content --}}
@stop