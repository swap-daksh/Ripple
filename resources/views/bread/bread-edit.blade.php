@extends('Ripple::layouts.app')
@section('page-content')
<div class="" style="margin: 0px;padding-bottom: 15px;" ng-app="EditBread" ng-controller="EditExistsBread">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" id="newBread">
                {!! csrf_field() !!}
                <input type="hidden" name="create-bread"  value="{!! $table !!}">
                <input type="hidden" name="bread-columns" id="bread-columns">
                <input type="hidden" name="bread-info" id="bread-info">
            </form>

            <div class="tab-content block block-default"> 
                <ul class="nav nav-tabs" id="breadSettingTabs" role="tablist"> 
                    <li role="presentation" class="active">
                        <a href="#bread-info-wrapper" id="bread-info-btn" role="tab" data-toggle="tab" aria-controls="enabled" aria-expanded="true"><strong><i class="fa fa-globe"></i>  Bread Info</strong></a>
                    </li> 
                    <li role="presentation" class="">
                        <a href="#bread-columns-wrapper" role="tab" id="disable-bread-tab" data-toggle="tab" aria-controls="disabled" aria-expanded="false"><strong><i class="fa fa-info-circle"></i> Bread Columns</strong></a>
                    </li> 
                </ul> 
                <div class="tab-pane fade active in clearfix" role="tabpanel" id="bread-info-wrapper" aria-labelledby="bread-info-wrapper"> 
                    <div class="row clearfix">
                        <div class="col-md-6 form-group">
                            <label for="email">Display Name (Singular)</label>
                            <input class="input-sm form-control"  placeholder="Display Name (Singular)" ng-model="bread.display_singular" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">Display Name (Plural)</label>
                            <input class="input-sm form-control" placeholder="Display Name (Plural)"  ng-model="bread.display_plural" type="text">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6 form-group">
                            <label for="email">URL Slug (must be unique)</label>
                            <input class="input-sm form-control" placeholder="URL slug (ex. posts)"  ng-model="bread.slug" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">Icon (optional) Use a <a href="//fontawesome.io/icons/" target="_blank">Font Awesome Class</a></label>
                            <input class="input-sm form-control" placeholder="Icon to use for this Table"  ng-model="bread.icon" type="text">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6 form-group">
                            <label for="email">Model Name</label>
                            <span class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="ex. \App\User, if left empty will try and use the table name"></span>
                            <input class="form-control input-sm" placeholder="Model Class Name"  ng-model="bread.model" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">Controller Name</label>
                            <span class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="ex. PageController, if left empty will use the BREAD Controller"></span>
                            <input class="form-control input-sm" placeholder="Controller Name"  ng-model="bread.controller" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control input-sm"  ng-model="bread.description" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="tab-pane fade in clearfix" role="tabpanel" id="bread-columns-wrapper" aria-labelledby="bread-columns-wrapper" > 
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th class="">Column</th>
                                            <th class="">Type</th>
                                            <th class="">Not Null</th>
                                            <th class="text-center">Required</th>
                                            <th class="text-center">Browse</th>
                                            <th class="text-center">Read</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Add</th>
                                            <th class="text-center">Delete</th>
                                            <th class="text-center" style="width: 150px;">Input Type</th>
                                            <th class="text-center" style="width: 200px;">Display Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Database::tableColumns($table) as $column=>$option)
                                        <tr>
                                            <td>
                                                {!! $column !!}
                                                @if($option['autoincrement'])
                                                <span class="text-success">(Autoincrement)</span>
                                                @endif
                                            </td>
                                            <td>{!! $option['dataType'] !!}</td>
                                            <td class="text-center">
                                                @if($option['notnull'])
                                                <span class="text-danger">Yes</span>
                                                @else
                                                <span class="text-warning">No</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <input ng-model="tblColums['{!! $column !!}'].required" type="checkbox" >
                                            </td>
                                            <td class="text-center">
                                                <input ng-model="tblColums['{!! $column !!}'].browse" type="checkbox" >
                                            </td>
                                            <td class="text-center">
                                                <input ng-model="tblColums['{!! $column !!}'].read" type="checkbox" >
                                            </td>
                                            <td class="text-center">
                                                <input ng-model="tblColums['{!! $column !!}'].edit" type="checkbox" >
                                            </td>
                                            <td class="text-center">
                                                <input ng-model="tblColums['{!! $column !!}'].add" type="checkbox" >
                                            </td>
                                            <td class="text-center">
                                                <input ng-model="tblColums['{!! $column !!}'].delete" type="checkbox" >
                                            </td>
                                            <td>
                                                <select ng-model="tblColums['{!! $column !!}'].type" class="form-control input-sm">
                                                    <option value="checkbox">Checkbox</option>
                                                    <option value="date">Date</option>
                                                    <option value="file">File</option>
                                                    <option value="image">Image</option>
                                                    <option value="multiple_images">Multiple Images</option>
                                                    <option value="number">Number</option>
                                                    <option value="password">Password</option>
                                                    <option value="radio_btn">Radio Button</option>
                                                    <option value="rich_text_box">Rich Text Box</option>
                                                    <option value="select_dropdown">Select Dropdown</option>
                                                    <option value="select_multiple">Select Multiple</option>
                                                    <option value="text" selected="">Text</option>
                                                    <option value="text_area">Text Area</option>
                                                    <option value="timestamp">Timestamp</option>
                                                    <option value="hidden">Hidden</option>
                                                    <option value="code_editor">Code Editor</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input-sm" ng-model="tblColums['{!! $column !!}'].display_name">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-info btn-block" ng-click="saveBread();"><i class="fa fa-save"></i> CREATE BREAD</button>
        </div>
    </div>
</div>
@stop
@push('page-script')
<script type="text/javascript">
    let Bread = angular.module('EditBread', []).config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[!!').endSymbol('!!]');
    });
    Bread.controller('EditExistsBread', ['$scope', function ($scope) {

            let columns = JSON.parse('{!! Database::tableColumns($table, "toJson") !!}');
            $scope.bread = {table: '{!! $table !!}', display_singular: '{!! str_singular($table) !!}', display_plural: '{!! str_plural($table) !!}', slug: '{!! str_slug($table, "-") !!}', icon: '', model: '', controller: '', description: ''};
            $scope.tblColums = {};
            for (let i in columns) {
                $scope.tblColums[i] = {column: columns[i].name, data_type: columns[i].dataType, required: columns[i].notnull, browse: true, read: true, edit: true, add: true, delete: true, type: 'text', display_name: columns[i].name};
            }


            $scope.breadInit = function () {
                $scope.columns = (JSON.parse('{!! $breadTableRows->toJson() !!}')).reverse();
            };
            $scope.submit = function () {
                $('#bread-columns').val(JSON.stringify($scope.columns));
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
</script>
@endpush




@section('abc')
<div class="page-header" style="margin: 0px;border-bottom: 1px solid gray;">
    <h1  style="margin: 0px;">Create BREAD/CRUD for <small></small></h1>
</div>
{{-- Page Content --}}
<div class="content" id="create-table" ng-app="editTableBread">
    <br>
    <br> 
    <form action="" method="post" ng-controller="EditBread" ng-submit="submit();" ng-init="breadInit();">
        <input type="hidden" value="{!! $breadDetails->id !!}" name="bread[detail][id]">
        <input type="hidden" value="" name="bread[columns]"  id="bread-columns">
        {!! csrf_field() !!}
        <input type="hidden" name="edit-bread"  value="{!! $breadDetails->id !!}">
        <div class="panel panel-primary panel-bordered">

            <div class="panel-heading">
                <h3 class="panel-title">"{!! $table !!}" BREAD info</h3>
            </div>

            <div class="panel-body">
                <div class="row clearfix">
                    <div class="col-md-6 form-group">
                        <label for="email">Display Name (Singular)</label>
                        <input class="form-control input-sm" name="bread[detail][display_singular]" value="{!! $breadDetails->display_singular !!}" id="display_name_singular" placeholder="Display Name (Singular)" type="text">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Display Name (Plural)</label>
                        <input class="form-control input-sm" id="display_name_plural" name="bread[detail][display_plural]" value="{!! $breadDetails->display_plural !!}" placeholder="Display Name (Plural)" type="text">
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6 form-group">
                        <label for="email">URL Slug (must be unique)</label>
                        <input class="form-control input-sm" name="bread[detail][slug]" value="{!! $breadDetails->slug !!}" placeholder="URL slug (ex. posts)" type="text">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Icon (optional) Use a <a href="//fontawesome.io/icons/" target="_blank">Font Awesome Class</a></label>
                        <input class="form-control input-sm" name="bread[detail][icon]" value="{!! $breadDetails->icon !!}" placeholder="Icon to use for this Table" type="text">
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6 form-group">
                        <label for="email">Model Name</label>
                        <span class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="ex. \App\User, if left empty will try and use the table name"></span>
                        <input class="form-control input-sm" name="bread[detail][model]" value="{!! $breadDetails->model !!}" placeholder="Model Class Name" type="text">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Controller Name</label>
                        <span class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="ex. PageController, if left empty will use the BREAD Controller"></span>
                        <input class="form-control input-sm" name="bread[detail][controller]" value="{!! $breadDetails->controller !!}" placeholder="Controller Name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control input-sm" name="bread[detail][description]" placeholder="Description">{!! $breadDetails->description !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Bread Rows:</label>
                    <div class="panel panel-primary panel-bordered">
                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="">Column</th>
                                                <th class="">Type</th>
                                                <th class="text-center">Required</th>
                                                <th class="text-center">Browse</th>
                                                <th class="text-center">Read</th>
                                                <th class="text-center">Edit</th>
                                                <th class="text-center">Add</th>
                                                <th class="text-center">Delete</th>
                                                <th class="text-center" style="width: 150px;">Input Type</th>
                                                <th class="text-center" style="width: 200px;">Display Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="column in columns">
                                                <td class="">
                                                    <strong>[!! column.column !!]</strong>
                                                </td>
                                                <td class="">
                                                    [!! column.data_type !!]
                                                </td>
                                                <td class="text-center">
                                                    <input ng-model="column.required" ng-true-value="1" ng-false-value="0" value="1" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input ng-model="column.browse" ng-true-value="1" ng-false-value="0" value="1" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input  ng-model="column.read" ng-true-value="1" ng-false-value="0" value="1" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input ng-model="column.edit" ng-true-value="1" ng-false-value="0" value="1" type="checkbox" >
                                                </td>
                                                <td class="text-center">
                                                    <input ng-model="column.add" ng-true-value="1" ng-false-value="0" value="1" type="checkbox" >
                                                </td>
                                                <td class="text-center">
                                                    <input ng-model="column.delete" ng-true-value="1" ng-false-value="0" value="1" type="checkbox" >
                                                </td>
                                                <td class="text-center">
                                                    <select name="" name="" id="" class="form-control input-sm" ng-model="column.type">
                                                        <option value="checkbox">Checkbox</option>
                                                        <option value="date">Date</option>
                                                        <option value="file">File</option>
                                                        <option value="image">Image</option>
                                                        <option value="multiple_images">Multiple Images</option>
                                                        <option value="number">Number</option>
                                                        <option value="password">Password</option>
                                                        <option value="radio_btn">Radio Button</option>
                                                        <option value="rich_text_box">Rich Text Box</option>
                                                        <option value="select_dropdown">Select Dropdown</option>
                                                        <option value="select_multiple">Select Multiple</option>
                                                        <option value="text" selected="">Text</option>
                                                        <option value="text_area">Text Area</option>
                                                        <option value="timestamp">Timestamp</option>
                                                        <option value="hidden">Hidden</option>
                                                        <option value="code_editor">Code Editor</option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <input name="" type="text" class="form-control input-sm" ng-model="column.display_name" value="[!! column.display_name !!]" style="width:200px;margin: auto">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Update BREAD</button>
                </div>
            </div><!-- .panel-body -->
        </div>

    </form>

</div>
{{-- END Page Content --}}
@stop