@extends('Ripple::layouts.beta-app')
@section('page-title') Categories List @stop
@section('buttons')
    <div class="buttons">
        <a href="{!! route('Ripple::adminAddCategories') !!}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New</a>
    </div>
@stop
@section('page-content')
    <div class="container-fluid p-3 mt-3">
        <div class="row">
            <div class="col">
                <div class="card mb-3 rounded-0 border-0">
                    <div class="card-body p-0">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                    Categories <span class="badge badge-light">{!!count(Ripple::allCategories()) !!}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    Tags <span class="badge badge-light">{!!count(Ripple::allTags()) !!}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                <table class="table border">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Parent</th>
                                            <th scope="col" class="w-5">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse(Ripple::allCategories() as $category)
                                        <tr>
                                            <th scope="row">{!! $category->id !!}</th>
                                            <td>sdfsdfd</td>
                                            <td>Slug</td>
                                            <td>Type</td>
                                            <td>Parent</td>
                                            <td>
                                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <a href="{!! route('Ripple::adminPostEdit', ['post'=>1]) !!}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                        <a href="{!! route('Ripple::adminPostEdit', ['post'=>1]) !!}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
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
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Parent</th>
                                            <th scope="col" class="w-5">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse(Ripple::allTags() as $tag)
                                        <tr>
                                            <th scope="row">{!! $category->id !!}</th>
                                            <td>sdfsdfd</td>
                                            <td>Slug</td>
                                            <td>Type</td>
                                            <td>Parent</td>
                                            <td>
                                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <a href="{!! route('Ripple::adminPostEdit', ['post'=>1]) !!}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                        <a href="{!! route('Ripple::adminPostEdit', ['post'=>1]) !!}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th scope="row" class="text-center text-danger" colspan="5"><i class="fas fa-exclamation-triangle "></i> Oops! There no tags available.</th>
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