@extends('Ripple::layouts.beta-app')
@section('page-title') Database table relations @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::databaseModule') !!}" class="btn btn-primary btn-sm"><i class="fa fa-database"></i> Database Modules</a>
    <a href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}" class="btn btn-info btn-sm"><i class="fa fa-cogs"></i> Bread Settings</a>
</div>
@stop
@section('page-content')

<div class="container-fluid p-3" ng-app="TableRelations" ng-controller="TableRelationController"> 
    <div class="col-md-12 p-0">
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card rounded-0">
                            <div class="card-header">
                                Create New Relation
                                <div class="float-right">
                                    <strong>This Relation Needs Synchronized Result ? <i class="fa fa-long-arrow-alt-right text-success"></i>&nbsp;</strong>
                                    
                                    <div class="custom-control custom-checkbox  float-right">
                                        <input class="custom-control-input " id="model-browse-3" ng-model="sync_result" value="1" name="sync_result" type="checkbox">
                                        <label class="custom-control-label" ng-click="syncResult()" for="model-browse-3"></label>
                                    </div>
                                            
                                </div>
                            </div>
                            <div class="card-body"> 
                                <form action="" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" value="true" name="table-relation">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <fieldset class="form-group"> 
                                                <label for="">Table</label>
                                                <select name="relation[rel_table]" ng-change="onChange('table')" ng-model="relation.table" class="custom-select">
                                                    <option value="">Select Table</option>
                                                    <option ng-repeat="table in tables" ng-if="table.substr(0, 3) !== 'rpl' && table !== 'migrations'">[!! table !!]</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="form-group" ng-disabled="!hasTableSelected">
                                                <label for="">Column</label>
                                                <select name="relation[rel_column]" ng-change="onChangeColumn('table');" ng-model="relation.column" class="custom-select" >
                                                    <option value="">Select Column</option>
                                                    <option value="[!! column !!]" ng-repeat="column in columns">[!! column !!]</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row" ng-if="hasColumnSelected">
                                        <div class="col">
                                            <fieldset class="form-group">
                                                <label for="">Reference Table</label>
                                                <select name="relation[ref_table]" ng-change="onChange('reference')" ng-model="relation.reference" class="custom-select">
                                                    <option value="">Select Table</option>
                                                    <option ng-repeat="table in tables" ng-if="table.substr(0, 3) !== 'rpl' && table !== 'migrations' && table !== relation.table">[!! table !!]</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col">
                                            <fieldset class="form-group" ng-disabled="!hasReferenceSelected">
                                                <label for="">Column</label>
                                                <select name="relation[ref_column]" ng-model="relation.ref_column" class="custom-select" >
                                                    <option value="">Select Column</option>
                                                    <option value="[!! column !!]" ng-repeat="column in referenceColumns">[!! column !!]</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col">
                                            <fieldset class="form-group">
                                                <label for="">Display Column Value</label>
                                                <select name="relation[ref_display]" ng-change="onChangeColumn('');" class="custom-select" ng-model="relation.ref_display">
                                                    <option value="">Select Column</option>
                                                    <option value="[!! column !!]" ng-repeat="column in referenceColumns">[!! column !!]</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div> 
                                    <div class="row mb-2" ng-if="is_sync_result">
                                        <input class="d-none" ng-model="sync_result" value="1" name="relation[sync_result]" type="checkbox">
                                        <div class="col">
                                            <label for="">Synchronise Result With Column</label><br>
                                            <select name="relation[sync_with]" ng-model="relation.sync_with" class="custom-select" >
                                                <option value="">Select Column</option>
                                                <option value="[!! column !!]" ng-repeat="column in columns">[!! column !!]</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="">Synchronise Result Table</label><br>
                                            <select name="relation[sync_table]" ng-change="syncTableColumns()" ng-model="relation.sync_table" class="custom-select">
                                                <option value="">Select Table</option>
                                                <option ng-repeat="table in tables" ng-if="table.substr(0, 3) !== 'rpl' && table !== 'migrations'">[!! table !!]</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="">Synchronise Result Column</label><br>
                                            <select name="relation[sync_column]" ng-model="relation.sync_column" class="custom-select">
                                                <option value="">Select Table</option>
                                                <option ng-repeat="sync_column in sync_columns" value="[!! sync_column !!]">[!! sync_column !!]</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" ng-if="hasReferenceColumnSelected">
                                        <div class="col text-center">
                                            <button class="btn btn-primary"><i class="fa fa-plus"></i> Create Relation</button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card rounded-0">
                            <div class="card-header">
                                Table Relations
                            </div>
                            <div class="card-body">
                                @foreach($relations as $relation)
                                @if($relation->status === 1)
                                <div class="alert alert-success" role="alert">
                                    <strong>{!! strtoupper($relation->rel_table) !!} <i class="fa fa-long-arrow-alt-right "></i> {!! ucfirst($relation->rel_column) !!}</strong>
                                    has relation to 
                                    <strong>{!! strtoupper($relation->ref_table) !!} <i class="fa fa-long-arrow-alt-right "></i> {!! ucfirst($relation->ref_column) !!}</strong>
                                    <sup>(Display column <strong>{!! strtoupper($relation->ref_display) !!}</strong>)</sup>
                                    <a class="close" href="{!! route('Ripple::deleteTableRelation', ['id'=>base64_encode($relation->id)]) !!}"><i class="fa fa-trash text-danger"></i></a>
                                </div>
                                @else
                                <div class="alert alert-danger" role="alert">
                                    <strong>{!! strtoupper($relation->rel_table) !!} <i class="fa fa-long-arrow-alt-right "></i> {!! ucfirst($relation->rel_column) !!}</strong>
                                    has relation to 
                                    <strong>{!! strtoupper($relation->ref_table) !!} <i class="fa fa-long-arrow-alt-right "></i> {!! ucfirst($relation->ref_column) !!}</strong>
                                    <sup>(Display column <strong>{!! strtoupper($relation->ref_display) !!}</strong>)</sup>
                                    <a class="close" href="{!! route('Ripple::deleteTableRelation', ['id'=>base64_encode($relation->id)]) !!}"><i class="fa fa-trash text-danger"></i></a>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid p-3">
    <div class="row">

    </div>
</div>
@stop
@push('page-script')
<script>

    let TableRelations = angular.module('TableRelations', []).config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[!!').endSymbol('!!]');
    });

    TableRelations.controller('TableRelationController', ['$scope', function ($scope) {
            $scope.tablesWithColumns = JSON.parse('{!! Database::tablesWithColumns("toJson") !!}');

            $scope.tables = Object.keys($scope.tablesWithColumns);
            $scope.referenceTables = $scope.tables;
            $scope.syncTables = $scope.tables;


            $scope.hasTableSelected = false;
            $scope.hasReferenceSelected = false;
            $scope.hasColumnSelected = false;
            $scope.hasReferenceColumnSelected = false;
            $scope.sync_result = false;
            $scope.is_sync_result = false;
            $scope.sync_columns = [];
            $scope.relation = {
                table: '',
                column: '',
                reference: '',
                ref_column: '',
                ref_display: '',
                sync_with: '',
                sync_table: '',
                sync_column: ''
            };


            /**
             * Does this Relation needs Synchronized Data?
             */
            $scope.syncResult = function(){
                $scope.is_sync_result = !$scope.is_sync_result;
            }

            /**
             * 
             */
            $scope.syncTableColumns = function(){
                console.log($scope.tablesWithColumns[$scope.relation.sync_table]);
                $scope.sync_columns = $scope.tablesWithColumns[$scope.relation.sync_table];
            };


            $scope.onChange = function (table) {
                if ($scope.relation.table === $scope.relation.reference || $scope.relation.reference === $scope.relation.table) {
                    $scope.relation[table] = '';
                    return false;
                }

                if (table === 'table') {
                    console.log($scope.relation.table);
                    if ($scope.relation.table !== '') {
                        $scope.columns = $scope.tablesWithColumns[$scope.relation.table];
                        $scope.hasTableSelected = true;
//                        $scope.hasColumnSelected = true;
                    } else {
                        $scope.hasTableSelected = false;
                        $scope.columns = [];
                        $scope.hasColumnSelected = false;
                    }
                } else {
                    console.log($scope.relation.reference);
                    if ($scope.relation.reference !== '') {
                        $scope.referenceColumns = $scope.tablesWithColumns[$scope.relation.reference];
                        $scope.hasReferenceSelected = true;
                        //$scope.hasReferenceColumnSelected = true;
                    } else {
                        $scope.hasTableSelected = false;
                        $scope.hasReferenceColumnSelected = false;
                        $scope.referenceColumns = [];
                    }
                }

            };

            $scope.onChangeColumn = function (table) {
                if (table === 'table') {
                    if ($scope.relation.column !== '') {
                        $scope.hasColumnSelected = true;
                    } else {
                        $scope.hasColumnSelected = false;
                    }
                } else {
                    if ($scope.relation.ref_column !== '') {
                        $scope.hasReferenceColumnSelected = true;
                    } else {
                        $scope.hasReferenceColumnSelected = false;
                    }
                }
            };


        $('.question-checkbox').prop('indeterminate', true)

        }]);
</script>
@endpush