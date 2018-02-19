@extends('Ripple::layouts.beta-app')
@section('page-title') Create New {!! ucfirst(str_singular($table)) !!} @stop
@section('buttons') 
<div class="buttons">
<button onClick="document.getElementById('AddBreadForm').submit();" class="btn btn-sm btn-success"><i class="fa fa-save"></i>  Save {!! ucfirst(str_singular($table)) !!}</button>
<a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Browse {!! ucfirst($bread->display_plural) !!}</a>

</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header">
                    New {!! ucfirst(str_singular($table)) !!}
                </div>
                <div class="card-body">
                    <form method="POST" id="AddBreadForm" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="bread-add" value="1">
                    <input type="hidden" name="table" value="{!! $table !!}" />
                    <div class="row">
                    @foreach($columns as $column)
                    @if($column->add)
                    <div class="col-md-6">
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
                                @case('text')
                                    <input class="form-control" type="text" name="column[{!! $column->column !!}]">
                                @break
                                @case('textarea')
                                    <textarea name="column[{!! $column->column !!}]"  cols="30" rows="5" class="form-control"></textarea>
                                @break 

                                @case('image')
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control" placeholder="Path to 'public/'" type="text" name="{!! $column->column !!}_upload_path">
                                    </div>
                                    <div class="col">
                                        <div class="custom-file">
                                            <input type="file" name="column[{!! $column->column !!}]" class="custom-file-input image-file" data-file="{!! $table.'_'.str_plural($column->column) !!}">
                                            <label class="custom-file-label" for="customFile" id="{!! $table.'_'.str_plural($column->column) !!}">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                                @break
                                @case('file')
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control" placeholder="Path to 'public/'" type="text" name="{!! $column->column !!}_upload_path">
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
                    </div>
                    <!--<div class="col-md-12 text-center p-0">
                        <hr>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>  Save {!! ucfirst(str_singular($table)) !!}</button>   
                    </div>-->
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