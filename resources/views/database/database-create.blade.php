@extends('Ripple::layouts.app')
@section('page-content')
{{-- Page Header --}}
<!--<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                <i class="fa fa-database"></i>&nbsp;New Table <small></small>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Category</li>
                <li><a class="link-effect" href="">Page</a></li>
            </ol>
        </div>
    </div>
</div>-->
{{-- END Page Header --}}

{{-- Page Content --}}
<div class="content">
    {{-- My Block --}}
    <div class="block">
        <div class="block-header">
            <ul class="block-options">
                <li>
                    <button type="button"><i class="si si-settings"></i></button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                </li>
            </ul>
            <h3 class="block-title">Create New Table</h3>
        </div>
        <div class="block-content clearfix">
            <div id="testselect"></div>
            <select class="datatypes" ></select>
            <form method="post" action="">
                {!! csrf_field() !!}
                <input type="hidden" value="zzz" name="create-table">
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
                                    Nullable
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
                            <tr>
                                <td>
                                    <input type="text" name="columns[1][name]" class="form-control table-input" value="id">
                                </td>
                                <td>
                                    <select class="form-control table-input" name="columns[1][type]" >
                                        <option value="integer">INTEGER</option>
                                        <option value="string">VARCHAR</option>
                                        <option value="text">TEXT</option>
                                        <option title="">DATE</option>
                                        <optgroup label="Numbers">
                                            <option value="tinyint">TINYINT</option>
                                            <option value="smallint">SMALLINT</option>
                                            <option value="mediumint">MEDIUMINT</option>
                                            <option value="integer"> INTEGER</option>
                                            <option value="bigint">BIGINT</option>
                                            <option value="float">FLOAT</option>
                                            <option value="double">DOUBLE</option>
                                            <option value="decimal">DECIMAL</option>
                                            <option value="boolean">BOOLEAN</option>
                                        </optgroup>
                                        <optgroup label="Strings">
                                            <option value="tinytext">TINYTEXT</option>
                                            <option value="mediumtext">MEDIUMTEXT</option>
                                            <option value="longtext">LONGTEXT</option>
                                            <option value="text">TEXT</option>
                                            <option value="varchar">VARCHAR</option>
                                            <option value="char">CHAR</option>
                                        </optgroup>
                                        <optgroup label="Date and Time">
                                            <option value="date">DATE</option>
                                            <option value="datetime">DATETIME</option>
                                            <option value="timestamp">TIMESTAMP</option>
                                            <option value="time">TIME</option>
                                            <option value="year">YEAR</option>
                                        </optgroup>
                                        <optgroup label="Binary">
                                            <option value="longblob">LONGBLOB</option>
                                            <option value="blob">BLOB</option>
                                            <option value="mediumblob">MEDIUMBLOB</option>
                                            <option value="tinyblob">TINYBLOB</option>
                                            <option value="binary">BINARY</option>
                                            <option value="varbinary">VARBINARY</option>
                                            <option value="bit">BIT</option>
                                        </optgroup>
                                        <optgroup label="Lists">
                                            <option value="set">SET</option>
                                            <option value="json">JSON</option>
                                            <option value="enum">ENUM</option>
                                        </optgroup>
                                        <optgroup label="Geometry">
                                            <option value="geometrycollection">GEOMETRYCOLLECTION</option>
                                            <option value="geometry">GEOMETRY</option>
                                            <option value="linestring">LINESTRING</option>
                                            <option value="multilinestring">MULTILINESTRING</option>
                                            <option value="multipoint">MULTIPOINT</option>
                                            <option value="multipolygon">MULTIPOLYGON</option>
                                            <option value="point">POINT</option>
                                            <option value="polygon">POLYGON</option>
                                        </optgroup>
                                        <optgroup label="Array & Object">
                                            <option value="array">Array</option>
                                            <option value="simple_array">SIMPLE ARRAY</option>
                                            <option value="json_array">JSON ARRAY</option>
                                            <option value="object">Object</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td>
                                    <input type="number"  name="columns[1][length]" class="form-control table-input" placeholder="Length">
                                </td>
                                <td>
                                    <select class="form-control table-input" name="columns[1][index]">
                                        <option value=""></option> 
                                        <option value="INDEX">INDEX</option> 
                                        <option value="UNIQUE">UNIQUE</option> 
                                        <option value="PRIMARY">PRIMARY</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control table-input" name="columns[1][default]" >
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input checked="" type="checkbox" name="columns[1][unsigned]" ><span></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input checked="" type="checkbox" name="columns[1][nullable]" ><span></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input checked="" type="checkbox" name="columns[1][autoIncrement]" ><span></span>
                                    </label>
                                </td>
                                <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="columns[2][name]" class="form-control table-input" value="id">
                                </td>
                                <td>
                                    <select class="form-control table-input" name="columns[2][type]" >
                                        <option value="integer">INTEGER</option>
                                        <option value="string">VARCHAR</option>
                                        <option value="text">TEXT</option>
                                        <option title="">DATE</option>
                                        <optgroup label="Numbers">
                                            <option value="tinyint">
                                                TINYINT
                                            </option><option value="smallint">
                                                SMALLINT
                                            </option><option value="mediumint">
                                                MEDIUMINT
                                            </option><option value="integer">
                                                INTEGER
                                            </option><option value="bigint">
                                                BIGINT
                                            </option><option value="float">
                                                FLOAT
                                            </option><option value="double">
                                                DOUBLE
                                            </option><option value="decimal">
                                                DECIMAL
                                            </option></optgroup>
                                        <optgroup label="Strings">
                                            <option value="tinytext">
                                                TINYTEXT
                                            </option>
                                            <option value="mediumtext">
                                                MEDIUMTEXT
                                            </option>
                                            <option value="longtext">
                                                LONGTEXT
                                            </option><option value="text">
                                                TEXT
                                            </option><option value="varchar">
                                                VARCHAR
                                            </option><option value="char">
                                                CHAR
                                            </option>
                                        </optgroup>
                                        <optgroup label="Date and Time"><option value="date">
                                                DATE
                                            </option><option value="datetime">
                                                DATETIME
                                            </option><option value="timestamp">
                                                TIMESTAMP
                                            </option><option value="time">
                                                TIME
                                            </option><option value="year">
                                                YEAR
                                            </option></optgroup><optgroup label="Binary"><option value="longblob">
                                                LONGBLOB
                                            </option><option value="blob">
                                                BLOB
                                            </option><option value="mediumblob">
                                                MEDIUMBLOB
                                            </option><option value="tinyblob">
                                                TINYBLOB
                                            </option><option value="binary">
                                                BINARY
                                            </option><option value="varbinary">
                                                VARBINARY
                                            </option><option value="bit">
                                                BIT
                                            </option></optgroup><optgroup label="Lists"><option disabled="disabled" value="set">
                                                SET
                                            </option><option value="json">
                                                JSON
                                            </option><option disabled="disabled" value="enum">
                                                ENUM
                                            </option></optgroup><optgroup label="Geometry"><option value="geometrycollection">
                                                GEOMETRYCOLLECTION
                                            </option><option value="geometry">
                                                GEOMETRY
                                            </option><option value="linestring">
                                                LINESTRING
                                            </option><option value="multilinestring">
                                                MULTILINESTRING
                                            </option><option value="multipoint">
                                                MULTIPOINT
                                            </option><option value="multipolygon">
                                                MULTIPOLYGON
                                            </option><option value="point">
                                                POINT
                                            </option><option value="polygon">
                                                POLYGON
                                            </option></optgroup>
                                    </select>
                                </td>
                                <td>
                                    <input type="number"  name="columns[2][length]" class="form-control table-input" placeholder="Length">
                                </td>
                                <td>
                                    <select class="form-control table-input" name="columns[2][index]">
                                        <option value=""></option> 
                                        <option value="INDEX">INDEX</option> 
                                        <option value="UNIQUE">UNIQUE</option> 
                                        <option value="PRIMARY">PRIMARY</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control table-input" name="columns[2][default]" >
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input checked="" type="checkbox" name="columns[2][unsigned]"><span></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input checked="" type="checkbox" name="columns[2][nullable]"><span></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input checked="" type="checkbox" name="columns[2][increment]"><span></span>
                                    </label>
                                </td>
                                <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 text-center margin-bottom">
                    <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add New Column</button>
                    <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Timestamps</button>
                    <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Soft Deletes</button>
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
@push('page-script')
<style>
    .table-input{
        min-width: 150px !important;
    }
</style>

<script>


    $(document).ready(function () {
        "use strict";$('#testselect').html($.dataTypeDropdown());
        $('.datatypes').dataTypeDropdown();
        var tr = $('tr');
    });
    function strReplaceAll(string, Find, Replace) {
    try {
        return string.replace(new RegExp(Find, "gi"), Replace);
    } catch (ex) {
        return string;
    }
}
</script>
@endpush