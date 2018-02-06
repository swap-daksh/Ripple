@extends('Ripple::layouts.beta-app')
@section('page-title') All available bread modules @stop
@section('page-description') List of all bread modules @stop
@section('page-content')
<div class="container-fluid p-3" > 
  <div class="col-md-12 border p-3">
    <table class="table m-0 table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Module</th> 
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      @forelse($breads as $bread)
        <tr>
          <th scope="row">{!! $loop->index + 1 !!}</th>
          <td>
          <strong>{!! ucfirst($bread->display_plural) !!}</strong>
          
          <p>
          @if(empty($bread->description))
          This is bread default BREAD module description. Basically Bread stands for <b>B</b>rowse <b>R</b>ead <b>E</b>dit <b>A</b>dd & <b>D</b>elete operations.
          @else
          {!! $bread->description !!}
          @endif
          </p>
          </td> 
          <td class="align-middle">
          <a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="btn btn-info btn-sm btn-block">Browse</a>
          </td>
        </tr>
        @empty
        @endforelse
      </tbody>
    </table>
  </div>  
</div>
@stop
