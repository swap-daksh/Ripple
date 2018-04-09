@extends('Ripple::layouts.app')
@section('page-content')

<div class="page-header" style="margin: 0px;border-bottom: 1px solid gray;">
    <h1  style="margin: 0px;">Table <small>{!! $table !!}</small></h1>
</div>
{{-- Page Content --}}
<div class="content" id="create-table" >
    {{-- My Block --}}
    <div class="panel">
        <div class="panel-body clearfix">
            <form method="post" action="">
                {!! csrf_field() !!}
                <input type="hidden" value="" name="columns">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless text-center">
                        <thead class="bg-primary">
                            <tr>
                                <th>Column</th>
                                <th class="text-center">
                                    Type
                                </th>
                                <th class="text-center">
                                    Length
                                </th>
                                <th class="text-center">
                                    Key
                                </th>
                                <th class="text-center">
                                    Default
                                </th>
                                <th class="text-center">
                                    Extra
                                </th>
                            </tr> 
                        </thead>
                        <tbody>
                            @foreach($columns as $column)
                            <tr>
                                <td>{!! $column->getName() !!}</td>
                                <td>{!! $column->getType() !!}</td>
                                <td>{!! $column->getLength() !!}</td>
                                <td>{!! $column->getType() !!}</td>
                                <td>{!! $column->getDefault() !!}</td>
                                <td>{!! $column->getType() !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    {{-- END My Block --}}
</div>
{{-- END Page Content --}}
@stop