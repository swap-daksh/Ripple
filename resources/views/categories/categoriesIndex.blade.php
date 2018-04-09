@extends('Ripple::layouts.beta-app')
@section('page-title') Categories List @stop

@section('page-content')
    <div class="container-fluid p-3 mt-3">
        <div class="row">
            <div class="col-8">
                <div class="card h-100 rounded-0">
                    <div class="card-header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active border border-1 border-primary rounded-0" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                    Categories <span class="badge badge-dark">{!!count(Ripple::allCategories()) !!}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border border-1 border-primary rounded-0" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    Tags <span class="badge badge-dark">{!!count(Ripple::allTags()) !!}</span>
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
                                            <td>{!! $category->name !!}</td>
                                            <td>{!! $category->slug !!}</td>
                                            <td>{!! $category->type !!}</td>
                                            <td>{!! $category->parent !!}</td>
                                            <td>
                                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <a href="{!! route('Ripple::adminEditCategory', ['id'=>$category->id]) !!}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                        <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
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
                                            <th scope="row">{!! $tag->id !!}</th>
                                            <td>{!! $tag->name !!}</td>
                                            <td>{!! $tag->slug !!}</td>
                                            <td>{!! $tag->type !!}</td>
                                            <td>{!! $tag->parent !!}</td>
                                            <td>
                                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <a href="{!! route('Ripple::adminEditCategory', ['id'=>$category->id]) !!}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                        <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
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
            <div class="col-4">
                <div class="card rounded-0">
                    <div class="card-header rounded-0">Add New Category/Tag</div>
                    <div class="card-body pb-0">


                        <form action="" method="post" id="create-category" >
                        {!! csrf_field() !!}
                            <input type="hidden" name="new-category" value="1"> 
                            <div class="row mb-1">
                                <label for="category-title" class="col-3">Title</label>
                                <div class="col">
                                    <input type="text" name="category[name]" id="category-title" class="form-control">
                                </div>
                            </div> 
                            <div class="row mb-1">
                                <label for="category-title" class="col-3">Type</label>
                                <div class="col">
                                    <select name="category[type]" class="custom-select">
                                        <option value="category">Category</option>
                                        <option value="tag">Tag</option>
                                    </select>
                                </div>  
                            </div>  
                            <div class="row mb-1">
                                <label for="category-title" class="col-3">Parent</label>
                                <div class="col">
                                    <select name="category[parent]" class="custom-select">
                                        <option value="0">---- No Parent ----</option>
                                        @foreach(DB::table(prefix('categories'))->get() as $category)
                                            @if($category->parent == 0)
                                                <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                                            @endif
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div> 
                            <div class="row"> 
                                <label for="category-title" class="col-3">Description</label>
                                <div class="col">
                                    <textarea name="category[description]" id="" cols="30" rows="3" class="form-control">&nbsp;</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center p-0 mb-3">
                                    <hr>
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"> </i>   Save Category/Tag</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


<div class="modal fade" id="trash" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@stop