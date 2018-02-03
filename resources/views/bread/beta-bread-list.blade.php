@extends('Ripple::layouts.beta-app')
@section('page-title') All available bread modules @stop
@section('page-description') List of all bread modules @stop
@section('page-content')
<div class="container-fluid p-3" >
    <div class="row">
        <!--<div class="container">-->
        <div class="col p-3 bg-white rounded box-shadow">
            @forelse($breads as $bread)
            <div class=" media text-muted pt-3  border border-bottom-1 border-top-0 border-right-0 border-left-0">
                <img data-src="holder.js/32x32?theme=thumb&amp;bg=6f42c1&amp;fg=6f42c1&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 40px; height: 40px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161573fca6b%20text%20%7B%20fill%3A%236f42c1%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161573fca6b%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%236f42c1%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2212.166666746139526%22%20y%3D%2216.999999976158144%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <p class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">{!! ucfirst($bread->display_plural) !!} <a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="float-right">Browse</a></strong>
                    @if(empty($bread->description))
                    This is bread default BREAD module description. Basically Bread stands for <b>B</b>rowse <b>R</b>ead <b>E</b>dit <b>A</b>dd & <b>D</b>elete operations.
                    @else
                    {!! $bread->description !!}
                    @endif
                </p>
            </div>
            @empty
            @endforelse
        </div>
            <!--</div>-->
    </div> 
</div>
</div>
@stop
