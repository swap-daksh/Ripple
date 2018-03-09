@extends('Ripple::layouts.beta-app')
@section('page-title') Blog Posts @stop
@section('buttons') 
<div class="buttons">
    <a href="{!! route('Ripple::adminPostAdd') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add New</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row">
        <div class="col">
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
                        <td>{!! $post->title !!}</td>
                        <td>{!! $post->title !!}</td>
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
@stop
@push('page-script')
<script>
</script>
@endpush