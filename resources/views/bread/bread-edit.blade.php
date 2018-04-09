@extends('Ripple::layouts.app')
@section('page-content')
<div class="" style="margin: 0px;padding-bottom: 15px;" ng-app="EditBread" ng-controller="EditExistsBread">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" id="editBread">
                {!! csrf_field() !!}
                <input type="hidden" name="edit-bread"  value="{!! $table !!}">
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
            <button class="btn btn-warning btn-block" ng-click="updateBread();"><i class="fa fa-cloud-upload"></i> UPDATE BREAD</button>
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

            let columns = JSON.parse('{!! Bread::getColumns($table, "toJson") !!}');
            $scope.bread = JSON.parse('{!! Bread::table($table, "toJson") !!}');
            $scope.tblColums = {};
            for (let i in columns) {
                $scope.tblColums[i] = {id:columns[i].id,column: columns[i].column, data_type: columns[i].data_type, required: !!+columns[i].required, browse: !!+columns[i].browse, read: !!+columns[i].read, edit: !!+columns[i].edit, add: !!+columns[i].add, delete: !!+columns[i].delete, type: columns[i].type, display_name: columns[i].display_name};
            }

            $scope.updateBread = function () {
                $('#bread-info').val(JSON.stringify($scope.bread));
                $('#bread-columns').val(JSON.stringify($scope.tblColums));
                $('#editBread').submit();
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