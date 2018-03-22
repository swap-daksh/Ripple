@extends('Ripple::layouts.beta-app')
@section('page-title') Create New {!! ucfirst(str_singular($table)) !!} @stop
@section('buttons') 
<div class="buttons">
<button onClick="document.getElementById('AddBreadForm').submit();" class="btn btn-sm btn-success"><i class="fa fa-save"></i>  Save {!! ucfirst(str_singular($table)) !!}</button>
<a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Browse {!! ucfirst($bread->display_plural) !!}</a>

</div>
@stop
@section('page-content')
<div class="container-fluid p-3 mt-3">
    <div class="row">
        <div class="col">
            <div class="card mb-3 rounded-0"> 
                <div class="card-body">
                    <form method="POST" id="AddBreadForm" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="bread-add" value="1">
                    <input type="hidden" name="table" value="{!! $table !!}" />
                    @foreach($columns as $column)
                    @if($column->add)
                    <div class="w-50 float-left">
                        <div class="form-group">
                            <label for="">{!! strtoupper($column->display_name) !!}</label>
                            @if(Relation::hasRelation($bread->table, $column->column)) 
                                @if(Relation::hasSyncRef($bread->table, $column->column))
                                    @php $dataSync = Relation::dataSync() @endphp
                                    <div id="{!! $table.'_'.str_plural($dataSync->rel_column).'_json' !!}" class="d-none">
                                        {!! json_encode($dataSync) !!}
                                    </div>
                                    <select id="{!! $table.'_'.str_plural($column->column) !!}" name="column[{!! $column->column !!}]" data-column="{!! ucfirst($column->column) !!}" class="custom-select syncRef" data-sync="{!! $dataSync->sync_result !!}" data-target="{!! $table.'_'.str_plural($dataSync->rel_column) !!}">
                                        <option value="">Select {!! ucfirst($column->column) !!}</option>
                                        @foreach(Relation::getRelation($bread->table, $column->column) as $key=>$value)
                                            @if(!Relation::isDependent($bread->table, $column->column))
                                            <option value="{!! $key !!}">{!! $value !!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                <select id="{!! $table.'_'.str_plural($column->column) !!}" data-column="{!! ucfirst($column->column) !!}" name="column[{!! $column->column !!}]" class="custom-select">
                                    <option value="">Select {!! ucfirst($column->column) !!}</option>
                                    @foreach(Relation::getRelation($bread->table, $column->column) as $key=>$value)
                                        @if(!Relation::isDependent($bread->table, $column->column))
                                        <option value="{!! $key !!}">{!! $value !!}</option>
                                        @endif
                                    @endforeach
                                </select>  
                                @endif
                            @else
                                @switch($column->type)

                                    @case('checkbox')
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="column[{!! $column->column !!}]" class="custom-control-input" value="1" id="{!! $column->column !!}_custom_checkbox">
                                        <label class="custom-control-label" for="{!! $column->column !!}_custom_checkbox">Check/Uncheck</label>
                                    </div>
                                    @break

                                    @case('hidden')
                                        <input class="form-control" type="hidden" name="column[{!! $column->column !!}]">
                                    @break

                                    @case('number')
                                        <input class="form-control" type="number" name="column[{!! $column->column !!}]">
                                    @break

                                    @case('password')
                                        <input class="form-control" type="password" name="column[{!! $column->column !!}]">
                                    @break

                                    @case('date')
                                        <input class="form-control" type="date" name="column[{!! $column->column !!}]">
                                    @break

                                    @case('text')
                                        <input class="form-control" type="text" name="column[{!! $column->column !!}]">
                                    @break

                                    @case('textarea')
                                        <textarea name="column[{!! $column->column !!}]"  cols="30" rows="5" class="form-control"></textarea>
                                    @break 

                                    @case('texteditor')
                                        <textarea class="form-control ripple_text_editor" name="column[{!! $column->column !!}]"></textarea>
                                    @break

                                    @case('image')
                                        <div class="card">
                                            <div class="card-body py-1">
                                                <div class="row">
                                                    <div class="col-4 p-0">
                                                        <div class="clearfix" id="preview-image"> 
                                                            <img width="auto" height="150" class="img-responsive" src="{!! ripple_asset('/img/default/default.png') !!}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-8 p-0">
                                                        <div id="{!! $column->column !!}_file_details_info" class="detail_info w-100 px-2">
                                                            <p><strong>Title:</strong>&nbsp;&nbsp;<code>______.___</code></p>
                                                            <p><strong>Size:</strong>&nbsp;&nbsp;<code>___.__ KB/MB</code></p>
                                                            <p><strong>Type:</strong>&nbsp;&nbsp;<code>_____/____</code></p>
                                                        </div>
                                                        <div class="row px-3">
                                                            <div class="col px-1">
                                                                <div class="input-group  mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend" data-toggle="tooltip" title="Specify your path under public directory.">
                                                                        <div class="input-group-text"><i class="fa fa-info-circle"></i></div>
                                                                    </div>
                                                                    <input class="form-control" placeholder="public/" type="text" name="{!! $column->column !!}_upload_path">
                                                                </div>
                                                            
                                                            </div>
                                                            <div class="col p-0">
                                                                <div class="custom-file">
                                                                    <input class="image-preview custom-file-input-bread" name="column[{!! $column->column !!}]" id="{!! $column->column !!}_custom_input_file" data-preview="preview-image" data-details="#{!! $column->column !!}_file_details_info" data-width="auto" data-height="150" type="file">
                                                                    <label class="custom-file-label rounded-right" for="{!! $column->column !!}_custom_input_file">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @break

                                    @case('file')
                                        <div class="row">
                                            <div class="col">
                                                <input class="form-control" placeholder="public/" type="text" name="{!! $column->column !!}_upload_path">
                                            </div>
                                            <div class="col">
                                                <div class="custom-file">
                                                    <input type="file" name="column[{!! $column->column !!}]" class="custom-file-input image-file" data-file="{!! $table.'_'.str_plural($column->column) !!}">
                                                    <label class="custom-file-label" for="customFile" id="{!! $table.'_'.str_plural($column->column) !!}">Choose file...</label>
                                                </div>
                                            </div>
                                        </div>
                                    @break

                                @endswitch 
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('page-script')
<script>
$(document).ready(function(){
    $(document).on('change', 'select[data-sync="1"].syncRef', function(){
        window.synchronize = {
            ele: $(this),
            rel: JSON.parse($('#'+$(this).attr('data-target')+'_json').html())
        };
        rel = window.synchronize.rel;
        window.synchronize.data = {
            _token: "{!! csrf_token() !!}",
            table: rel.ref_table,
            column: rel.sync_column,
            column_value: $(this).val()
        }; 
        $.post(route('Ripple::ajaxGetSynchronizedColumn'), window.synchronize.data, function(data){
            var HTML = "<option value=''>Select "+$('#'+window.synchronize.ele.attr('data-target')).attr('data-column')+"</option>";
            var rel = window.synchronize.rel;
            for(let i in data){
                HTML += "<option value='"+data[i][rel.ref_column]+"'>"+data[i][rel.ref_display]+"</option>";
            }
            $('#'+window.synchronize.ele.attr('data-target')).html(HTML);
        });
    });

    $(document).on('change', '.image-file', function(){ 
        $('#'+$(this).attr('data-file')).html($(this)[0].files[0].name);
    });
});
</script>
@endpush