@extends('Ripple::layouts.app')
@section('page-content')
<div class="page-header" style="margin: 0px;border-bottom: 1px solid gray;">
    <h1  style="margin: 0px;">Database <small>Tables</small></h1>
</div>
{{-- Page Content --}}
<div class="content" id="create-table" ng-app="createTable">
    {{-- My Block --}}
    <div class="panel" ng-controller="NewTableController">
        <div class="panel-body clearfix">
            <form method="post" action="" ng-submit="saveTable()">
                {!! csrf_field() !!}
                <input type="hidden" value="" name="columns">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless text-center">
                        <thead>
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
                                    unsigned
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
                                    <input type="text" ng-model="column.name" ng-disabled="hasIdCreatedUpdatedDeleted(column)" class="form-control table-input">
                                </td>
                                <td>
                                    <select ng-disabled="hasIdCreatedUpdatedDeleted(column)" class="form-control table-input" ng-model="column.type" >
                                        @include('Ripple::database.table-components.data-types')
                                    </select>
                                </td>
                                <td>
                                    <input ng-disabled="hasIdCreatedUpdatedDeleted(column)" type="number" ng-model="column.length" class="form-control table-input" placeholder="Length">
                                </td>
                                <td>
                                    <select ng-disabled="hasIdCreatedUpdatedDeleted(column)" class="form-control table-input" ng-model="column.index" >
                                        <option value="">NO INDEX</option> 
                                        <option value="INDEX">INDEX</option> 
                                        <option value="UNIQUE">UNIQUE</option> 
                                        <option value="PRIMARY">PRIMARY</option>
                                    </select>
                                </td>
                                <td>
                                    <input ng-disabled="hasIdCreatedUpdatedDeleted(column)" type="text" ng-model="column.default" class="form-control table-input"  >
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input ng-disabled="hasIdCreatedUpdatedDeleted(column)" ng-if="column.unsigned"  checked="" type="checkbox" ng-model="column.unsigned">
                                        <input ng-disabled="hasIdCreatedUpdatedDeleted(column)" ng-if="!column.unsigned"  type="checkbox" ng-model="column.unsigned">
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input ng-disabled="hasIdCreatedUpdatedDeleted(column)" ng-if="column.notnull" ng-model="column.notnull" checked="" type="checkbox">
                                        <input ng-disabled="hasIdCreatedUpdatedDeleted(column)" ng-if="!column.notnull"  type="checkbox"  ng-model="column.notnull" >
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input ng-disabled="hasIdCreatedUpdatedDeleted(column)" ng-if="column.autoincrement"  checked="" type="checkbox" ng-model="column.autoincrement">
                                        <input ng-disabled="hasIdCreatedUpdatedDeleted(column)" ng-if="!column.autoincrement"  type="checkbox"  ng-model="column.autoincrement">
                                        <span></span>
                                    </label>
                                </td>
                                <td><button ng-click="removeColumn($index)" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 text-center margin-bottom">
                    <button class="btn btn-primary"  type="button" ng-click="addColumn()"><i class="fa fa-plus"></i> Add New Column</button>
                    <button class="btn btn-primary" type="button" ng-click="timeStamps()"><i class="fa fa-plus"></i> Add Timestamps</button>
                    <button class="btn btn-primary" type="button" ng-click="deletedAt()"><i class="fa fa-plus"></i> Add Soft Deletes</button>
                </div>
                <div class="col-md-12 text-center margin-bottom no-padding">

                    <hr>
                    <div class="col-md-6 no-padding">
                        <input type="text" name="table" class="form-control" placeholder="Table Name">
                    </div>
                    <div class="col-md-6 no-padding">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Create Table</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- END My Block --}}
</div>
{{-- END Page Content --}}
@stop

@include('Ripple::database.table-components.column-template')
@push('page-script')
<script type="text/javascript">
    let createDatabase = angular.module('createTable', []);
    createDatabase.controller('NewTableController', ['$scope', function ($scope) {
            $scope.columns = [{name: 'id', type: 'integer', length: 11, index: 'PRIMARY', default: null, unsigned: true, notnull: true, autoincrement: true}];
            $scope.addColumn = function () {
                let Columns = $scope.columns, hasCreatedAtIndex = false;
                let Column = {name: '', type: 'varchar', length: 255, index: null, default: null, unsigned: false, notnull: false, autoincrement: false};
                for (let i in Columns) {
                    if (Columns[i].name === 'created_at') {
                        hasCreatedAtIndex = i;
                    }
                }
                if (hasCreatedAtIndex) {
                    $scope.columns.splice(hasCreatedAtIndex, 0, Column);
                } else {
                    $scope.columns.push(Column);
                }

            };
            $scope.removeColumn = function (index) {
                if ($scope.columns[index].name !== 'id') {
                    $scope.columns.splice(index, 1);
                } else {
                    toastr.error('"id" column cannot be deleted', 'Oops!')
                }
            };
            $scope.saveTable = function (event) {
                $('input[name=columns]').val(JSON.stringify($scope.columns));
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