@extends('Ripple::layouts.app')
@section('page-content')
<div class="row">
    <div class="col-md-12">
        <div class="block block-default" data-example-id="togglable-tabs"> 
            <ul class="nav nav-tabs" id="breadSettingTabs" role="tablist"> 
                <li role="presentation" class="active">
                    <a href="#list-tables" role="tab" id="disable-bread-tab" data-toggle="tab" aria-controls="disabled" aria-expanded="false"><strong><i class="fa fa-info-circle"></i> Tables List</strong></a>
                </li> 
                <li role="presentation">
                    <a href="#create-tables" id="enable-bread-tab" role="tab" data-toggle="tab" aria-controls="enabled" aria-expanded="true"><strong><i class="fa fa-globe"></i>  New Table</strong></a>
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
        <div class="tab-content vertical-tab-content" style="margin-bottom: 15px;">
            <div class="tab-pane fade in clearfix active" role="tabpanel" id="list-tables" aria-labelledby="list-tables">
                <div class="block block-default" data-example-id="togglable-tabs"> 
                    <div class="block-heading"><strong style="text-transform: uppercase;">List Tables</strong></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="text-center" style="width: 20px;"><i class="fa fa-photo text-info"></i></th>
                                <th>Display Name</th>
                                <th style="width: 30%;">Table Name</th>
                                <th style="width: 15%;">Bread</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tables as $table) 
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-info-circle text-info"></i>
                                </td>
                                <td class="font-w600">{!! ucwords(str_replace('_', ' ', $table)) !!}</td>
                                <td><code>{!! $table !!}</code></td>
                                <td>
                                    @if(Ripple::hasEnabledBread($table))
                                    @if(DB::table('breads')->where('table', $table)->exists())
                                    <a class="btn btn-xs btn-info btn-block" href="{!! route('Ripple::adminEditBread', ['table' => $table]) !!}"><i class="fa fa-pencil-square-o"></i> Update</a>
                                    @else
                                    <a class="btn btn-xs btn-success btn-block" href="{!! route('Ripple::adminCreateBread', ['table'=>$table]) !!}"><i class="fa fa-pencil"></i> Create</a>
                                    @endif
                                    @else
                                    <a class="btn btn-xs btn-warning disabled btn-block" href="javascript:void(0);"><i class="fa fa-ban "></i> Disabled</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-success" href="{!! route('Ripple::adminViewTable', ['table'=>$table]) !!}" data-toggle="tooltip" title="" data-original-title="View Table"><i class="fa fa-eye"></i></a>

                                        <button class="btn btn-xs btn-danger" type="button" data-toggle="tooltip" title="" data-original-title="Delete Table"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade in clearfix" role="tabpanel" id="create-tables"  ng-app="createTable" ng-controller="NewTableController" aria-labelledby="create-tables">
                <div class="block block-default" data-example-id="togglable-tabs"> 
                    <div class="block-heading"><strong style="text-transform: uppercase;">Create Table</strong></div>
                </div>
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-6">
                        <input type="text" placeholder="Table Name" id="" ng-model="table.name" class="form-control input-sm">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-warning btn-sm" ng-click="timeStamps()"><i class="fa fa-plus"></i> Add Timestamps</button>
                    </div>
                    <div class="col-md-2" style="margin-bottom: 0px;">
                        <button class="btn btn-block btn-danger btn-sm" ng-click="deletedAt()"><i class="fa fa-plus"></i> Add Soft Deletes</button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success btn-block btn-sm" ng-click="saveTable();" type="submit"><i class="fa fa-save"></i> Create Table</button>
                    </div>
                </div>
                <div class="col-md-8" style="padding-left: 0px;"  >
                    <form id="create-table" method="post" action="">
                        {!! csrf_field() !!}
                        <input type="hidden" name="columns">
                        <input type="hidden" name="table" >
                    </form> 
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead style="background:#2B3137; color: #fff">
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">
                                        Type
                                    </th>
                                    <th class="text-center">
                                        Length
                                    </th>
                                    <th class="text-center">
                                        Index
                                    </th>
                                    <th class="text-center">
                                        Default
                                    </th>
                                    <th class="text-center">
                                        Unsigned
                                    </th>
                                    <th class="text-center">
                                        NotNull
                                    </th>
                                    <th class="text-center">
                                        Increment
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-bolt"></i>
                                    </th>
                                </tr> 
                            </thead>
                            <tbody>
                                <tr ng-repeat="column in columns" ng-class="rowClass(column)">
                                    <td>
                                        [!! column.name !!]
                                    </td>
                                    <td>
                                        [!! column.type !!]
                                    </td>
                                    <td>
                                        [!! column.length !!]
                                    </td>
                                    <td>
                                        [!! column.index !!]
                                    </td>
                                    <td>
                                        [!! column.default !!]
                                    </td>
                                    <td class="text-center">
                                        [!! column.unsigned !!]
                                    </td>
                                    <td class="text-center">
                                        [!! column.notnull !!]
                                    </td>
                                    <td class="text-center">
                                        [!! column.autoincrement !!]
                                    </td>
                                    <td class="text-center"><i class="fa fa-trash text-danger" ng-click="removeColumn($index)"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-md-4 no-padding" ng-init="defaultColumn()">
                    <div class="panel panel-default" style="border-radius: 0px;">
                        <div class="panel-heading text-center" style="border-radius: 0px;"><i class="fa fa-plus-circle" ></i>   Add New Column</div>
                        <div class="panel-body clearfix">
                            <div class="form-group clearfix" ng-class="hasError.name ? 'has-error' : ''">
                                <input class="form-control input-sm" id="" ng-model="insertColumn.name" name="column-name" type="text" placeholder="Column Name">
                                <input hidden id="" ng-model="insertColumn.autoincrement" value="1" type="hidden">
                            </div>
                            <div class="form-group clearfix" ng-class="hasError.type ? 'has-error' : ''">
                                <select ng-model="insertColumn.type" id="setting-type" data-id='setting-type' class="form-control input-sm setting-type">
                                    <option value="">Type</option>
                                    @include('Ripple::database.table-components.data-types')
                                </select>
                            </div>
                            <div class="form-group clearfix" ng-class="hasError.length ? 'has-error' : ''">
                                <input class="form-control input-sm " id="" ng-model="insertColumn.length" type="text" placeholder="Character Length">
                            </div>
                            <div class="form-group clearfix" ng-class="hasError.default ? 'has-error' : ''">
                                <input class="form-control input-sm " id="" ng-model="insertColumn.default" type="text" placeholder="Default Value">
                            </div>
                            <!--                            <div class="form-group clearfix">
                                                            <select name="" class="form-control input-sm" id="" ng-model="insertColumn.index">
                                                                <option value="">No Index</option> 
                                                                <option value="INDEX">INDEX</option> 
                                                                <option value="UNIQUE">UNIQUE</option> 
                                                                <option value="PRIMARY">PRIMARY</option>
                                                            </select>
                                                        </div>-->
                            <!--                            <div class="form-group clearfix">
                                                            <select class="form-control input-sm" id="" ng-model="insertColumn.notnull">
                                                                <option  value="true">Nullable</option>
                                                                <option value="false">Not Null</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group clearfix">
                                                            <select class="form-control input-sm" id="" ng-model="insertColumn.unsigned">
                                                                <option value="true">Signed</option>
                                                                <option value="false">Unsigned</option>
                                                            </select>
                                                        </div>-->
                            <div class="form-group clearfix">
                                <button class="btn btn-block btn-info btn-sm" ng-click="addColumn(insertColumn)"><i class="fa fa-plus-square"></i>  Add Column</button>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="tab-pane fade in clearfix " role="tabpanel" id="seo-setting" aria-labelledby="general-setting">
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
<!--<div class="page-header" style="margin: 0px;">
    <h1  style="margin: 0px;">Database <small>Tables</small> <a  href="{!! route('Ripple::adminCreateTable') !!}" class="btn btn-success btn-sm">Create Table</a></h1>
</div>-->
@stop
@push('page-script')
<script type="text/javascript">
    let createDatabase = angular.module('createTable', []).config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[!!').endSymbol('!!]');
    });

    createDatabase.controller('NewTableController', ['$scope', function ($scope) {



            $scope.defaultColumn = function () {
                $scope.insertColumn = {name: '', type: 'varchar', length: 255, index: null, default: '', unsigned: false, notnull: false, autoincrement: false};
            };
            $scope.hasError = {name: false, type: false, length: false, default: false};
            $scope.columns = [{name: 'id', type: 'integer', length: 11, index: 'PRIMARY', default: null, unsigned: true, notnull: true, autoincrement: true}];
            $scope.addColumn = function (insertColumn) {
                let Columns = $scope.columns, hasCreatedAtIndex = false;
                $scope.checkColumn();
                //return false;
                for (let i in Columns) {
                    if (Columns[i].name === 'created_at') {
                        hasCreatedAtIndex = i;
                    }
                }
                if (hasCreatedAtIndex) {
                    $scope.columns.splice(hasCreatedAtIndex, 0, insertColumn);
                } else {
                    $scope.columns.push(insertColumn);
                }
                $scope.defaultColumn();
            };

            $scope.checkColumn = function () {
                for (let i in $scope.insertColumn) {
                    if ($scope.insertColumn[i] == '') {
                        $scope.hasError[i] = true;
                    } else {
                        $scope.hasError[i] = false;
                    }
                }
            };
            $scope.removeColumn = function (index) {
                if ($scope.columns[index].name !== 'id') {
                    $scope.columns.splice(index, 1);
                } else {
                    toastr.error('"id" column cannot be deleted', 'Oops!');
                }
            };
            $scope.saveTable = function (event) {
                $scope.table.columns = JSON.stringify($scope.columns);
                //console.log(JSON.stringify($scope.table));
                $('input[name=table]').val($scope.table.name);
                $('input[name=columns]').val(JSON.stringify($scope.columns));
                document.getElementById('create-table').submit();
            };
            $scope.timeStamps = function () {
                let Columns = $scope.columns, hasCreatedAt = false, hasUpdatedAt = false;
                let created_at = {name: 'created_at', type: 'timestamp', length: null, index: null, default: null, unsigned: false, notnull: false, autoincrement: false};
                let updated_at = {name: 'updated_at', type: 'timestamp', length: null, index: null, default: null, unsigned: false, notnull: false, autoincrement: false};
                for (let i in Columns) {
                    if (Columns[i].name === created_at.name) {
                        hasCreatedAt = true;
                    }
                    if (Columns[i].name === updated_at.name) {
                        hasUpdatedAt = true;
                    }
                }
                if (!hasCreatedAt && !hasUpdatedAt) {
                    if (Columns[(Columns.length - 1)].name === 'deleted_at') {
                        $scope.columns.splice((Columns.length - 1), 0, created_at, updated_at);
                    } else {
                        $scope.columns.push(created_at, updated_at);
                    }
                } else {
                    toastr.error('"created_at" Column already exists', 'Oops!');
                    toastr.error('"updated_at" Column already exists', 'Oops!');
                }
            };
            $scope.deletedAt = function () {
                let Columns = $scope.columns, hasDeletedAt = false;
                let deleted_at = {name: 'deleted_at', type: 'timestamp', length: null, index: null, default: null, unsigned: false, notnull: false, autoincrement: false};
                for (let i in Columns) {
                    if (Columns[i].name === deleted_at.name) {
                        hasDeletedAt = true;
                    }
                }
                if (!hasDeletedAt) {
                    $scope.columns.splice((Columns.length), 0, deleted_at);
                } else {
                    toastr.error('"deleted_at" column already exists', 'Oops!');
                }
            };
            $scope.hasIdCreatedUpdatedDeleted = function (column) {
                if (column.name === 'id' || column.name === 'created_at' || column.name === 'updated_at' || column.name === 'deleted_at') {
                    return true;
                } else {
                    return false;
                }
            }
            $scope.rowClass = function (column) {
                if (column.name === 'id' || column.name === 'created_at' || column.name === 'updated_at' || column.name === 'deleted_at') {
                    return column.name;
                } else {
                    return 'column';
                }
            };
        }]);</script>
<style>
    .table-input{
        min-width: 150px !important;
    }
</style>
<script>
    $(document).ready(function () {
        "use strict";
        $('.datatypes').dataTypeDropdown();
        var tr = $('tr');
    });

</script>
@endpush