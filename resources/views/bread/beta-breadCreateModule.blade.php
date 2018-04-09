@extends('Ripple::layouts.beta-app')
@section('page-title') New Bread for table "{!! $table !!}" @stop
@section('buttons') 
<div class="buttons">
    <button class="btn btn-success btn-sm" onClick="document.getElementById('createNewBread').click();"><i class="fa fa-save"></i> Create BREAD</button>
    <a href="{!! route('Ripple::databaseTableBreads') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Table Breads</a>
</div>
@stop
@section('page-content')

<div class="container-fluid p3 mt-3"  ng-app="NewBread" ng-controller="CreateNewBread">
    <div class="row">
        <div class="col">
            <div class="card mb-3 rounded-0"> 
                <div class="card-body">
                    <form action="" method="post" id="NewBread" class="d-none">
                        {!! csrf_field() !!}
                        <input type="hidden" name="create-bread"  value="{!! $table !!}">
                        <input type="hidden" name="bread-columns" id="bread-columns">
                        <input type="hidden" name="bread-info" id="bread-info">
                        <button hidden id="createNewBread" ng-click="onSaveBread();"></button>
                    </form>
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

                    <div class="card rounded-0">
                        <div class="card-header rounded-0 text-white" style="background:#6f42c1;">
                            <i class="fa fa-clipboard "></i> Edit the rows for the permission_groups table below:
                        </div>
                        <div class="card-body">
                            <table class="table table-striped mb-0 border border-1">
                                    <thead class="">
                                        <tr>
                                            <th class="">Column</th>
                                            <th class="">Visiblity</th>
                                            <th class="">Input Type</th>
                                            <th class="">Display Name</th>
                                            <th class="">Optional Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Database::tableColumns($table) as $column=>$option)
                                        <tr>
                                                    <td>
                                                        <h2 class="m-0">{!! $column !!}</h2>
                                                        @if($option['autoincrement'])
                                                        <p class="m-0"><strong>Key: </strong> Primary</p>
                                                        <p class="m-0"><strong>Increment: </strong> Autoincrement</p>
                                                        @endif
                                                       <p class="m-0"> <strong>Required: </strong> @if($option['notnull']) Yes @else No @endif  </p>
                                                        <p class="m-0"><strong>Type: </strong> {!! $option['dataType'] !!} </p>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="{!! $column.'-required-'.$loop->index !!}" ng-model="tblColumns['{!! $column !!}'].required" type="checkbox" ng-disabled="tblColumns['{!! $column !!}'].required">
                                                            <label class="custom-control-label" for="{!! $column.'-required-'.$loop->index !!}">Required</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="{!! $column.'-browse-'.$loop->index !!}" ng-model="tblColumns['{!! $column !!}'].browse" type="checkbox">
                                                            <label class="custom-control-label" for="{!! $column.'-browse-'.$loop->index !!}">Browse</label>
                                                        </div> 
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="{!! $column.'-read-'.$loop->index !!}" ng-model="tblColumns['{!! $column !!}'].read" type="checkbox">
                                                            <label class="custom-control-label" for="{!! $column.'-read-'.$loop->index !!}">Read</label>
                                                        </div> 
                                                        <div class="custom-control custom-checkbox">
                                                            @if($option['autoincrement'])
                                                            <input class="custom-control-input" id="{!! $column.'-edit-'.$loop->index !!}" ng-model="tblColumns['{!! $column !!}'].edit" type="checkbox" ng-disabled="true">
                                                            @else
                                                            <input class="custom-control-input" id="{!! $column.'-edit-'.$loop->index !!}" ng-model="tblColumns['{!! $column !!}'].edit" type="checkbox">
                                                            @endif 
                                                            <label class="custom-control-label" for="{!! $column.'-edit-'.$loop->index !!}">Edit</label>
                                                        </div> 
                                                        <div class="custom-control custom-checkbox">
                                                            @if($option['autoincrement'])
                                                            <input class="custom-control-input" id="{!! $column.'-add-'.$loop->index !!}" ng-model="tblColumns['{!! $column !!}'].add" type="checkbox" ng-disabled="true">
                                                            @else
                                                            <input class="custom-control-input" id="{!! $column.'-add-'.$loop->index !!}" ng-model="tblColumns['{!! $column !!}'].add" type="checkbox">
                                                            @endif
                                                            <label class="custom-control-label" for="{!! $column.'-add-'.$loop->index !!}">Add</label>
                                                        </div> 
                                                        <div class="custom-control custom-checkbox"> 
                                                            <input class="custom-control-input" id="{!! $column.'-delete-'.$loop->index !!}" ng-model="tblColumns['{!! $column !!}'].delete" type="checkbox">
                                                            <label class="custom-control-label" for="{!! $column.'-delete-'.$loop->index !!}">Delete</label>
                                                        </div> 
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <select ng-model="tblColumns['{!! $column !!}'].type" class="custom-select input-sm">
                                                            <option value="checkbox">Checkbox</option>
                                                            <option value="date">Date</option>
                                                            <option value="select">Dropdown Select</option>
                                                            <option value="file">File</option>
                                                            <option value="image">Image</option>
                                                            <option value="number">Number</option>
                                                            <option value="multi_select">Multi Select</option>
                                                            <option value="password">Password</option> 
                                                            <option value="texteditor">Text Editor</option>
                                                            <option value="text">Text</option>
                                                            <option value="text_area">Text Area</option> 
                                                            <option value="time">Time</option>
                                                            <option value="hidden">Hidden</option> 
                                                        </select>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" class="form-control input-sm" ng-model="tblColumns['{!! $column !!}'].display_name">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <textarea ng-disabled="(tblColumns['{!! $column !!}'].type == 'select' || tblColumns['{!! $column !!}'].type == 'multi_select') ? false : onDisableOptions('{!! $column !!}')" ng-model="tblColumns['{!! $column !!}'].options" cols="30" rows="2" class="form-control" ></textarea>
                                                    </td> 
                                                </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                                <button class="btn btn-success btn-sm" onClick="document.getElementById('createNewBread').click();"><i class="fa fa-save"></i> Create Bread</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@stop
@push('page-script')
<script type="text/javascript">
    let Bread = angular.module('NewBread', []).config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[!!').endSymbol('!!]');
    });;
    Bread.controller('CreateNewBread', ['$scope', function ($scope) {
            let columns = JSON.parse('{!! Database::tableColumns($table, "toJson") !!}');
            $scope.bread = {table: '{!! $table !!}', display_singular: '{!! str_singular($table) !!}', display_plural: '{!! str_plural($table) !!}', slug: '{!! str_slug($table, "-") !!}', icon: '', model: '', controller: '', description: ''};
            $scope.tblColumns = {};
            for (let i in columns) {
                if(columns[i].autoincrement){
                    $scope.tblColumns[i] = {column: columns[i].column, data_type: columns[i].dataType, required: columns[i].notnull, browse: true, read: true, edit: false, add: false, delete: true, type: 'text', display_name: columns[i].column, options: ''};
                }else{
                    $scope.tblColumns[i] = {column: columns[i].column, data_type: columns[i].dataType, required: columns[i].notnull, browse: true, read: true, edit: true, add: true, delete: true, type: 'text', display_name: columns[i].column, options: ''};
                }
            }

            $scope.onSaveBread = function () {
                $('#bread-columns').val(JSON.stringify($scope.tblColumns));
                $('#bread-info').val(JSON.stringify($scope.bread));
                $('#NewBread').submit();
            };

            $scope.onDisableOptions = function (column) {
                $scope.tblColumns[column].options = '';
                        console.log($scope.tblColumns[column].options);
                        return true;
            };
        }]);
</script>
@endpush
