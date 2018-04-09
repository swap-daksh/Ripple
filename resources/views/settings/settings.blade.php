@extends('Ripple::layouts.app')
@section('ng-app')Settings @stop
@section('page-content')
<div class="" style="margin: 0px;padding-bottom: 15px;" ng-app="Settings">
    <div class="row">
        <div class="col-md-12">
            <div class="block block-default" data-example-id="togglable-tabs"> 
                <ul class="nav nav-tabs" id="breadSettingTabs" role="tablist"> 
                    <li role="presentation" class="active">
                        <a href="#general-setting" id="enable-bread-tab" role="tab" data-toggle="tab" aria-controls="enabled" aria-expanded="true"><strong><i class="fa fa-globe"></i>  General Settings</strong></a>
                    </li> 
                    <li role="presentation" class="">
                        <a href="#bread-setting" role="tab" id="disable-bread-tab" data-toggle="tab" aria-controls="disabled" aria-expanded="false"><strong><i class="fa fa-info-circle"></i> Bread Settings</strong></a>
                    </li> 
                    <li role="presentation" class="">
                        <a href="#seo-setting" role="tab" id="disable-bread-tab" data-toggle="tab" aria-controls="disabled" aria-expanded="false"><strong><i class="fa fa-info-circle"></i> SEO Settings</strong></a>
                    </li> 
                    <li role="presentation" class="">
                        <a href="#social-setting" role="tab" id="disable-bread-tab" data-toggle="tab" aria-controls="disabled" aria-expanded="false"><strong><i class="fa fa-info-circle"></i> Social Settings</strong></a>
                    </li> 
                </ul> 
            </div>
        </div> 
        <div class="col-md-12">
            <div class="tab-content vertical-tab-content"> 
                <div class="tab-pane fade active in clearfix" role="tabpanel" id="general-setting" aria-labelledby="general-setting"> 
                    <div class="block block-default" data-example-id="togglable-tabs"> 
                        <div class="block-heading"><strong style="text-transform: uppercase;">General Settings</strong></div>
                    </div>
                    <form class="form-horizontal" id="update-settings" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="zzz" name="setting-update"> 
                        {!! csrf_field() !!}
                        <div class="col-md-8" style="padding-left: 0px;">
                            <div id="accordion" class="panel-group">
                                @forelse($settings as $setting)
                                <div class="panel panel-default" style="border-radius: 0px;">
                                    <div class="panel-heading" style="border-radius: 0px;">
                                        <h4 class="panel-title" style="cursor: pointer" data-toggle="collapse" data-parent="#accordion" href="#{!! $loop->index !!}" aria-expanded="false">
                                            <a class="accordion-toggle collapsed"  href="javascript:void(0);">
                                                <i class="fa fa-cogs"></i>&nbsp; {!! ucwords(strtolower($setting->display_name)) !!}
                                            </a>
                                            <a class="pull-right accordion-toggle collapsed"  href="javascript:void(0);">
                                                <code>Ripple::setting('title')</code>
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{!! $loop->index !!}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
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
                        </div>
                    </form>
                    <div class="col-md-4 no-padding">
                        <div class="panel panel-default" style="border-radius: 0px;">
                            <div class="panel-heading text-center" style="border-radius: 0px;"><i class="fa fa-plus-circle" ></i>   Add New Setting</div>
                            <div class="panel-body clearfix">
                                <form method="post" action="" id="add_new_setting">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="setting-create" value="zzz">
                                    <input type="hidden" name="group" value="general">
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
                                    <div class="form-group clearfix">
                                        <button class="btn btn-block btn-info btn-sm"><i class="fa fa-plus-square"></i>  Add Setting</button>
                                    </div>
                                </form>
                                <div class="form-group clearfix" style="margin-bottom: 0px;">
                                    <button class="btn btn-block btn-warning btn-sm" onclick="document.getElementById('update-settings').submit();"><i class="fa fa-save"></i> Update Settings</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="tab-pane fade in clearfix" role="tabpanel" id="bread-setting" aria-labelledby="bread-setting" ng-controller="UpdateBreadStatus"> 
                    <div class="block block-default" data-example-id="togglable-tabs"> 
                        <div class="block-heading"><strong style="text-transform: uppercase;">BREAD Settings</strong></div>
                    </div>
                    <div class="col-md-2 no-padding">
                        <div class="tabs-vertical" data-example-id="togglable-tabs"> 
                            <ul class="nav nav-tabs" id="breadSettingTabs" role="tablist"> 
                                <li role="presentation" class="active">
                                    <a href="#disable-bread" id="enable-bread-tab" role="tab" data-toggle="tab" aria-controls="enabled" aria-expanded="true"><strong><i class="fa fa-square-o"></i>  Disable Bread</strong></a>
                                </li> 
                                <li role="presentation" class="">
                                    <a href="#enable-bread" role="tab" id="disable-bread-tab" data-toggle="tab" aria-controls="disabled" aria-expanded="false"><strong><i class="fa fa-check-square-o"></i> Enable Bread</strong></a>
                                </li> 
                                <li role="presentation" class="">
                                    <a href="#browse-columns" role="tab" id="disable-bread-tab" data-toggle="tab" aria-controls="disabled" aria-expanded="false"><strong><i class="fa fa-check-square-o"></i> Browse Columns</strong></a>
                                </li> 
                            </ul> 
                        </div>
                    </div> 
                    <div class="col-md-10" style="padding-right: 0px; ">
                        <div class="tab-content vertical-tab-content"> 
                            <div class="tab-pane fade active in clearfix" role="tabpanel" id="disable-bread" aria-labelledby="enable-bread"> 
                                <div class="col-md-6 no-padding" ng-repeat="bread in breadTables" ng-if="(bread.status)" >
                                    <div class="well well-sm " style="margin: 7px;">
                                        <i class="fa fa-list-alt"></i>   [!! (bread.table).substr(0,1).toUpperCase() + (bread.table).substr(1).toLowerCase() !!]
                                        <div class="pull-right">
                                            <i class="fa fa-check-square-o [!! (bread.table) !!]-status-icon text-success" style="cursor: pointer" ng-click="updateStatus((bread.table), $index);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab-pane fade clearfix" role="tabpanel" id="enable-bread" aria-labelledby="disable-bread"> 
                                <div class="col-md-6 no-padding" ng-repeat="bread in breadTables" ng-if="!(bread.status)" >
                                    <div class="well well-sm text-danger" style="margin: 7px;">
                                        <i class="fa fa-list-alt"></i>   [!! (bread.table).substr(0,1).toUpperCase() + (bread.table).substr(1).toLowerCase() !!]
                                        <div class="pull-right">
                                            <i class="fa fa-square-o [!! (bread.table) !!]-status-icon text-danger" style="cursor: pointer" ng-click="updateStatus((bread.table), $index);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab-pane fade clearfix" role="tabpanel" id="browse-columns" aria-labelledby="browse-columns"> 
                                <div id="accordionone" class="panel-group">
                                    <div class="col-md-12 no-padding" ng-repeat="bread in breadTables" ng-if="(bread.status)">
                                        <div class="panel panel-default" style="border-radius: 0px;">
                                            <div class="panel-heading" style="border-radius: 0px;">
                                                <h4 class="panel-title" style="cursor: pointer" data-toggle="collapse" data-parent="#accordionone" href="#[!! bread.table !!]-column" aria-expanded="false">
                                                    <a class="accordion-toggle collapsed"  href="javascript:void(0);">
                                                        <i class="fa fa-cogs"></i>&nbsp;  [!! (bread.table).substr(0,1).toUpperCase() + (bread.table).substr(1).toLowerCase() !!]
                                                    </a>
                                                    <a class="pull-right accordion-toggle collapsed"  href="javascript:void(0);">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="[!! bread.table !!]-column" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    <button class="btn btn-xs btn-default" style="margin-right: 5px" ng-repeat="column in bread.columns">[!! column !!]</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div>
                </div>
                <div class="tab-pane fade in clearfix" role="tabpanel" id="seo-setting" aria-labelledby="general-setting">
                    <div class="block block-default" data-example-id="togglable-tabs"> 
                        <div class="block-heading"><strong style="text-transform: uppercase;">SEO Settings</strong></div>
                    </div>
                </div>
                <div class="tab-pane fade in clearfix" role="tabpanel" id="social-setting" aria-labelledby="social-setting">
                    <div class="block block-default" data-example-id="togglable-tabs"> 
                        <div class="block-heading"><strong style="text-transform: uppercase;">Social Settings</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- END Page Content --}}
@stop
@push('page-script')
<script type="text/javascript">
            let Setting = angular.module('Settings', []).config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[!!').endSymbol('!!]');
    });

    Setting.controller('UpdateBreadStatus', ['$scope', '$http', function ($scope, $http) {
            $scope.breadTables = JSON.parse('{!! json_encode(Ripple::tablesBreadWithStatus()) !!}');
            $scope.updateStatus = function (table, index) {
                $('.' + table + '-status-icon').removeClass('fa-check-square-o fa-square-o').toggleClass('fa-spinner fa-spin');
                $http.post('{!! route("Ripple::updateBreadStatus") !!}', {_token: '{!! csrf_token() !!}', table: table}).then(function (response, status) {
                    let data = response.data;
                    if (data.status === 'OK') {
                        $scope.breadTables[index].status = (!$scope.breadTables[index].status);
                        toastr.success(data.msg, 'SUCCESS!');
                    } else { 
                        $('.' + table + '-status-icon').removeClass('fa-spinner fa-spin').toggleClass('fa-check-square-o fa-square-o');
                        toastr.error(data.msg, 'ERROR!');
                        
                    }
                }, function (data, status) {
                    console.log(data, status);
                });
            };
        }]);

    /*
     * @functionDeclarations
     */

    function strReplaceAll(string, Find, Replace) {
        try {
            return string.replace(new RegExp(Find, "gi"), Replace);
        } catch (ex) {
            return string;
        }
    }
    function titleCase(str) {
        return str
                .toLowerCase()
                .split('_')
                .map(function (word) {
                    return word[0].toUpperCase() + word.substr(1);
                })
                .join(' ');
    }
</script>
@endpush