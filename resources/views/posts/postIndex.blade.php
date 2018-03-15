@extends('Ripple::layouts.beta-app')
@section('page-title') Blog Posts @stop
@section('buttons') 
<div class="buttons btn-group">
    <a href="{!! route('Ripple::adminPostAdd') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add New</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row">
        <div class="col">
            <div class="card rounded-0">
                <div class="card-header">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link border border-1 border-primary rounded-0 active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                Published <span class="badge badge-dark">{!!count(Ripple::posts()) !!}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border border-1 border-primary rounded-0" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                Draft <span class="badge badge-dark">{!!count(Ripple::posts('status', 'draft')) !!}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <table class="table border">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Categories</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse(Ripple::posts() as $post)
                                <tr>
                                    <th scope="row">{!! $post->title !!}</th>
                                    <td>{!! $post->title !!}Mark</td>
                                    <td>{!! $post->title !!}</td>
                                    <td><span class="badge p-1 badge-@if($post->status == 'publish')success @else danger @endif">{!! ucfirst($post->status) !!}</span></td>
                                    <td>
                                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{!! route('Ripple::adminPostEdit', ['post'=>$post->id]) !!}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <a href="{!! route('Ripple::adminPostEdit', ['post'=>$post->id]) !!}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>


                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" class="text-center text-danger" colspan="5"><i class="fas fa-exclamation-triangle "></i> Oops! There no posts available.</th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <table class="table border">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Categories</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse(Ripple::posts('status', 'draft') as $post)
                                <tr>
                                    <th scope="row">{!! $post->title !!}</th>
                                    <td>{!! $post->title !!}Mark</td>
                                    <td>{!! $post->title !!}</td>
                                    <td><span class="badge p-1 @if($post->status == 'publish') badge-success @else badge-danger @endif">{!! ucfirst($post->status) !!}</span></td>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                <a href="{!! route('Ripple::adminPostEdit', ['post'=>$post->id]) !!}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                <a href="{!! route('Ripple::adminPostEdit', ['post'=>$post->id]) !!}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div> 
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" class="text-center text-danger" colspan="5"><i class="fas fa-exclamation-triangle "></i> Oops! There no posts available.</th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('page-script')
<script>
</script>
@endpush