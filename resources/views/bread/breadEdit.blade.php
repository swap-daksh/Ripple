@extends('Ripple::layouts.beta-app')
@section('page-title') Update {!! ucfirst(str_singular($table)) !!} @stop
@section('page-description') {!! $bread->description !!} @stop
@section('buttons')
    <button class="btn btn-success btn-sm" onClick="document.getElementById('update-bread').submit();" type="submit"><i class="fa fa-cloud-upload"></i> Update {!! ucfirst(str_singular($bread->display_singular)) !!}</button>
    {{--<a href="{!! route('Ripple::adminBreadAdd', ['slug'=>$bread->slug]) !!}" class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Add {!! ucfirst($bread->display_singular) !!}</a>--}}
    <a href="{!! route('Ripple::adminBreadView', ['slug'=>$bread->slug, 'id'=>$edit->id]) !!}" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> View {!! ucfirst($bread->display_singular) !!}</a> 
    <a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Browse {!! ucfirst($bread->display_plural) !!}</a> 

@stop
@section('page-content')

<div class="container-fluid p-3"> 
    <div class="col-md-12 p-0">
        <div class="card rounded-0">
            <div class="card-body">
                <form id="update-bread" method="post" action="" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="bread-edit" value="1">
                    <input type="hidden" name="table" value="{!! $table !!}" />
                    <input type="hidden" name="edit-id" value="{!! $edit->id !!}" />
                    <div class="row">
                        @foreach($columns as $column)
                        @if($column->edit)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{!! strtoupper($column->display_name) !!}</label>
                                @if(Relation::hasRelation($bread->table, $column->column))
                                    <select name="column[{!! $column->column !!}]" class="custom-select">
                                        <option value="">Select {!! ucfirst($column->column) !!}</option>
                                        @foreach(Relation::getRelation($bread->table, $column->column) as $key=>$value)
                                        @if($edit->{$column->column} == $key)
                                        <option value="{!! $key !!}" selected>{!! $value !!}</option>
                                        @else
                                        <option value="{!! $key !!}">{!! $value !!}</option>
                                        @endif
                                        @endforeach
                                    </select> 
                                @else

                                    @switch($column->type)

                                    @case('hidden')
                                        <input class="form-control" type="hidden" name="column[{!! $column->column !!}]" value="{!! $edit->{$column->column} !!}" >
                                    @break

                                    @case('number')
                                        <input class="form-control" type="number" name="column[{!! $column->column !!}]" value="{!! $edit->{$column->column} !!}" >
                                    @break

                                    @case('password')
                                        <input class="form-control" type="password" name="column[{!! $column->column !!}]" value="{!! $edit->{$column->column} !!}" >
                                    @break

                                    @case('date')
                                        <input class="form-control" type="date" name="column[{!! $column->column !!}]" value="{!! $edit->{$column->column} !!}" >
                                    @break

                                    @case('image')
                                    <div class="card">
                                        <div class="card-body py-1">
                                            <div class="row">
                                                <div class="col-4 p-0">
                                                    <div class="clearfix" id="preview-image">
                                                        @if($edit->{$column->column} == '')
                                                         <img width="auto" height="150" class="img-responsive" src="{!! ripple_asset('/img/default/default.png') !!}" alt="">
                                                        @else
                                                         <img style="max-width: 200px; max-height:150px" class="img-responsive" src="{!! url(Storage::url($edit->{$column->column})) !!}" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-8 p-0">
                                                    <div id="{!! $column->column !!}_file_details_info" class="detail_info w-100 px-2">
                                                        @if($edit->{$column->column} == '')
                                                            <p><strong>Title:</strong>&nbsp;&nbsp;<code>_________.___</code></p>
                                                            <p><strong>Size:</strong>&nbsp;&nbsp;<code>__.__ KB/MB</code></p>
                                                            <p><strong>Type:</strong>&nbsp;&nbsp;<code>___/____</code></p>
                                                        @else
                                                            <p><strong>Title:</strong>&nbsp;&nbsp;<code>{!! basename(Storage::url($edit->{$column->column})) !!}</code></p>
                                                            <p><strong>Size:</strong>&nbsp;&nbsp;<code>{!! storage_file_size($edit->{$column->column}) !!}</code></p>
                                                            <p><strong>Type:</strong>&nbsp;&nbsp;<code>{!! Storage::getMimetype($edit->{$column->column}) !!}</code></p>
                                                        @endif
                                                    </div> 
                                                    <div class="row px-3">
                                                        <div class="col px-1">
                                                            <div class="input-group  mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text"><i class="fa fa-info-circle"></i></div>
                                                                </div>
                                                                <input class="form-control" placeholder="public/" type="text" name="{!! $column->column !!}_upload_path">
                                                            </div>
                                                        </div>
                                                        <div class="col p-0">
                                                            <div class="custom-file">
                                                                <input class="image-preview custom-file-input-bread" name="column[{!! $column->column !!}]" id="{!! $column->column !!}" data-preview="preview-image" data-details="#{!! $column->column !!}_file_details_info" data-width="200" data-height="150" type="file">
                                                                <label class="custom-file-label" for="{!! $column->column !!}">Choose file</label>
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
                                                    <input type="file" name="column[{!! $column->column !!}]" class="custom-file-input" data-file="{!! $table.'_'.str_plural($column->column) !!}">
                                                    <label class="custom-file-label" for="customFile" id="{!! $table.'_'.str_plural($column->column) !!}">Choose file...</label>
                                                </div>
                                            </div>
                                        </div>
                                    @break 

                                    @case('text')
                                    <input class="form-control" value="{!! $edit->{$column->column} !!}" type="text" name="column[{!! $column->column !!}]">
                                    @break


                                    @case('textarea')
                                    <textarea name="column[{!! $column->column !!}]" id="" cols="30" rows="5" class="form-control">{!! $edit->{$column->column} !!}</textarea>
                                    @break

                                    @case('texteditor')
                                        <textarea class="form-control ripple_text_editor" name="column[{!! $column->column !!}]">{!! $edit->{$column->column} !!}</textarea>
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
@stop