@extends('Ripple::layouts.app')
@section('page-content')

{{-- Page Content --}}
<div class="content" id="create-table" ng-app="createTable">
    {{-- My Block --}}
    <div class="block" ng-controller="NewTableController">
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
        @yield('table-template')
            <!-- <database-table :table="table"></database-table> -->
                        </div>
    </div>
    {{-- END My Block --}}
</div>
{{-- END Page Content --}}
@stop
@include('Ripple::database.table-components.table-template')
@include('Ripple::database.table-components.column-template')
@push('page-script')
<script>
let createDatabase = angular.module('createTable', []);
createDatabase.controller('NewTableController', function NewTableController(){
    window.alert('hello how are you');
});
</script>
<style>
    .table-input{
        min-width: 150px !important;
    }
</style>

<script>
    //vue component
    Vue.component('table-columns', {
        props: {
            column: {
                type: Object,
                required: true,
            },
            index: {
                required: true
            }
        },
        data() {
            return {
                dataTypes: dataTypeJsonAlt()
            };
        },
        template: `@yield('table-column-template')`,
        methods: {
            deleteColumn(){}
        }
    });

    //table component
    Vue.component('database-table', {
        props: {
            table: {
                type: Object,
                required: true,
                twoWay: true
            }
        },
        data() {
            return {
                columns: [
                    {
                        name: 'id',
                        type: 'int',
                        length: '',
                        index: 'PRIMARY',
                        default: null,
                        unSigned: true,
                        notnull: true,
                        autoincrement: true
                    }
                ]
            };
        },
        template: `@yield('table-template')`,

        methods: {
            makeColumn(o) {
                return $.extend({
                    name: '',
                    type: 'int',
                    length: '',
                    index: '',
                    default: '',
                    unSigned: false,
                    notnull: false,
                    autoincrement: false
                }, o);
            },
            addColumns() {
                this.columns.push(this.makeColumn());
                var column = this.columns;
                var tableColumn = [];
                for (var i in column) {
                    tableColumn.push({
                        'name': column[i].name,
                        'type': column[i].type,
                        'index': column[i].index,
                        'default': column[i].default,
                        'unsigned': column[i].unSigned,
                        'notnull': column[i].notnull,
                        'autoincrement': column[i].autoincrement
                    });
                    $('input[name=table-columns]').val(JSON.stringify(tableColumn));
                }
            },
            deleteColumn(index) {
                alert(index);
//                console.log(this.columns);
//                this.$emit('columnDeleted', this.column);

                // todo: add an UNDO button or something in case the user mistakenly deletes the column
            },
        }
    });




    var app = new Vue({
        el: '#create-table',
        data: {
            table: {},
            columns: [],
        },
        methods: {
        }
    });
    $(document).ready(function () {
        "use strict";
        $('.datatypes').dataTypeDropdown();
        var tr = $('tr');
    });

</script>
@endpush