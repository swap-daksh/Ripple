@extends('Ripple::layouts.beta-app')
@section('page-title') Database Table List @stop
@section('page-description') List all tables of database @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::databaseModule') !!}" class="btn btn-primary btn-sm"><i class="fa fa-database"></i> Database Modules</a>
    <a href="{!! route('Ripple::adminCreateTable') !!}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add New Table</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row">
        <div class="col">
            <div class="card mb-3 rounded-0"> 
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Display Name</th>
                                <th>Table Name</th>
                                <th class="w-10">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tables as $table) 
                            <tr>
                                <th >{!! $loop->index + 1 !!}</th>
                                <td>{!! ucwords(str_replace('_', ' ', $table)) !!}</td>
                                <td><code>{!! $table !!}</code></td>
                                <td class="w-10">
                                    <a class="btn btn-sm btn-link" href="{!! route('Ripple::adminViewTable', ['table'=>$table]) !!}" ><i class="fa fa-eye"></i> Browse</a>
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