@extends('Ripple::layouts.app')
@section('page-content')
{{-- Page Header --}}
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Database <small>Subtitle.</small>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Category</li>
                <li><a class="link-effect" href="">Page</a></li>
            </ol>
        </div>
    </div>
</div>
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
            <h3 class="block-title">Tables</h3>
        </div>
        <div class="block-content">
            <p>
                <div id="accordion" class="panel-group">
        @foreach($tables as $table)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#{!! $table.'_'.$loop->index !!}" aria-expanded="false">
                    <a class="accordion-toggle collapsed"  href="javascript:void(0);">
                        <i class="fa fa-angle-double-right"></i>&nbsp; {!! strtoupper($table) !!}
                    </a>
                </h4>
            </div>
            <div id="{!! $table.'_'.$loop->index !!}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                    <a class="btn btn-sm btn-success" href="javascript:void(0);"><i class="fa fa-eye"></i> View</a>
                    <a class="btn btn-sm btn-info" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>
                    <a class="btn btn-sm btn-danger" href="javascript:void(0);"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
            </p>
        </div>
    </div>
    {{-- END My Block --}}
</div>
{{-- END Page Content --}}
@stop