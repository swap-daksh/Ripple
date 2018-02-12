@extends('Ripple::layouts.beta-app')
@section('page-title') Update {!! $table !!} @stop
@section('buttons') 
<div class="col text-right p-0">
    <button class="btn btn-sm btn-success" onClick="document.getElementById('updateBreadBtn').click();"><i class="fa fa-save"></i> Update BREAD</button>
    <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete Bread</a>
    <a href="{!! route('Ripple::databaseTableBreads') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Table Breads</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3" ng-app="EditBread" ng-controller="EditExistsBread">
    <div class="row">
        <div class="col">
            <div class="card mb-3 rounded-0"> 
                <div class="card-body">
                    <form action="" method="post" id="editBread" class="d-none">
                        {!! csrf_field() !!}
                        <input type="hidden" name="edit-bread"  value="{!! $table !!}">
                        <input type="hidden" name="bread-columns" id="bread-columns">
                        <input type="hidden" name="bread-info" id="bread-info">
                        <button hidden id="updateBreadBtn" ng-click="updateBread();" ></button>
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
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div id="accordion">
                                <div class="card rounded-0">
                                    <div class="card-header rounded-0" style="background:#6f42c1;" id="headingOne">
                                        <h5 class="mb-0">
                                            <button style="text-decoration: none;" class="btn btn-block btn-link text-white" data-toggle="collapse" data-target="#breadColumns" aria-expanded="true" aria-controls="breadColumns">
                                                <i class="fa fa-edit"></i> Bread Columns
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="breadColumns" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-striped mb-0">
                                                    <thead class="thead-dark">
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
                                                            <th scope="row">
                                                                {!! $column !!}
                                                                @if($option['autoincrement'])
                                                                <span class="text-success">(Autoincrement)</span>
                                                                @endif
                                                            </th>
                                                            <td>{!! $option['dataType'] !!}</td>
                                                            <td class="text-center">
                                                                @if($option['notnull'])
                                                                <span class="text-danger">Yes</span>
                                                                @else
                                                                <span class="text-warning">No</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input" id="{!! $column.'-required-'.$loop->index !!}" ng-model="tblColums['{!! $column !!}'].required" type="checkbox">
                                                                    <label class="custom-control-label" for="{!! $column.'-required-'.$loop->index !!}"></label>
                                                                </div> 
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input" id="{!! $column.'-browse-'.$loop->index !!}" ng-model="tblColums['{!! $column !!}'].browse" type="checkbox">
                                                                    <label class="custom-control-label" for="{!! $column.'-browse-'.$loop->index !!}"></label>
                                                                </div> 
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input" id="{!! $column.'-read-'.$loop->index !!}" ng-model="tblColums['{!! $column !!}'].read" type="checkbox">
                                                                    <label class="custom-control-label" for="{!! $column.'-read-'.$loop->index !!}"></label>
                                                                </div> 
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input" id="{!! $column.'-edit-'.$loop->index !!}" ng-model="tblColums['{!! $column !!}'].edit" type="checkbox">
                                                                    <label class="custom-control-label" for="{!! $column.'-edit-'.$loop->index !!}"></label>
                                                                </div> 
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="custom-control custom-checkbox">
                                                                    @if($option['autoincrement'])
                                                                    <input class="custom-control-input" id="{!! $column.'-add-'.$loop->index !!}" ng-model="tblColums['{!! $column !!}'].add" type="checkbox" disabled>
                                                                    @else
                                                                    <input class="custom-control-input" id="{!! $column.'-add-'.$loop->index !!}" ng-model="tblColums['{!! $column !!}'].add" type="checkbox">
                                                                    @endif
                                                                    <label class="custom-control-label" for="{!! $column.'-add-'.$loop->index !!}"></label>
                                                                </div> 
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input" id="{!! $column.'-delete-'.$loop->index !!}" ng-model="tblColums['{!! $column !!}'].delete" type="checkbox">
                                                                    <label class="custom-control-label" for="{!! $column.'-delete-'.$loop->index !!}"></label>
                                                                </div> 
                                                            </td>
                                                            <td>
                                                                <select ng-model="tblColums['{!! $column !!}'].type" class="custom-select input-sm">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete <b></b> bread?</p>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal"><i class="fa fa-times"></i> No, Cancel</button>
                <a href="{!! route('Ripple::adminDeleteBread', ['table'=>$table]) !!}" class="btn btn-danger mx-auto"><i class="fa fa-trash"></i> Yes, Delete</a>
            </div>
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
                console.log(columns[i].autoincrement);
                $scope.tblColums[i] = {id: columns[i].id, column: columns[i].column, data_type: columns[i].data_type, required: !!+columns[i].required, browse: !!+columns[i].browse, read: !!+columns[i].read, edit: !!+columns[i].edit, add: !!+columns[i].add, delete: !!+columns[i].delete, type: columns[i].type, display_name: columns[i].display_name};
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