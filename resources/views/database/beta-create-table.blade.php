@extends('Ripple::layouts.beta-app') 
@section('page-title') Create New Table @stop
@section('page-description') Here you can create a new database table. @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::databaseModule') !!}" class="btn btn-primary btn-sm"><i class="fa fa-database"></i> Database Modules</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3" ng-app="createTable" ng-controller="NewTableController"> 
    <div class="row">
        <div class="col"> 
            <div class="card">
                <div class="card-body clearfix">
                <div class="row mb-3">
                        <div class="col-6">
                            <input type="text" placeholder="Table Name" id="" ng-model="table.name" class="form-control input-sm">
                        </div>
                        <div class="col-2 align-middle">
                            <button class="btn btn-block btn-warning btn-sm" ng-click="timeStamps()"><i class="fa fa-plus"></i> Add Timestamps</button>
                        </div>
                        <div class="col-2 align-middle">
                            <button class="btn btn-block btn-danger btn-sm" ng-click="deletedAt()"><i class="fa fa-plus"></i> Add Soft Deletes</button>
                        </div>
                        <div class="col-2 align-middle">
                            <button class="btn btn-success btn-block btn-sm" ng-click="saveTable();" type="submit"><i class="fa fa-save"></i> Create Table</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
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
                        <div class="col-md-4">
                            <div class="card rounded-0">
                                <div class="card-header bg-dark rounded-0 text-white">
                                    Add New Column
                                </div>
                                <div class="card-body">
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
                                    <div class="form-group clearfix">
                                        <button class="btn btn-block btn-info btn-sm" ng-click="addColumn(insertColumn)"><i class="fa fa-plus-square"></i>  Add Column</button>
                                    </div>
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
    })
            ;

</script>
@endpush